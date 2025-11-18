<?php 
include '../includes/header.php'; 

if ($_SESSION['role'] != 'projectmanager') {
    header("Location: ../auth/login.php");
    exit();
}

$manager_id = $_SESSION['user_id'];

// Ambil semua proyek milik manager
$projects = [];
$projects_result = mysqli_query($conn, "SELECT * FROM projects WHERE manager_id='$manager_id'");
while ($row = mysqli_fetch_assoc($projects_result)) {
    $projects[] = $row;
}

// Ambil semua Team Member milik manager
$members = [];
$members_result = mysqli_query($conn, "SELECT * FROM users WHERE project_manager_id='$manager_id' AND role='team'");
while ($row = mysqli_fetch_assoc($members_result)) {
    $members[] = $row;
}

// Variabel edit mode
$edit_mode = false;
$editing_task = null;

// Tambah tugas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_task'])) {
    $nama_tugas = mysqli_real_escape_string($conn, $_POST['nama_tugas']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $project_id = mysqli_real_escape_string($conn, $_POST['project_id']);
    $assigned_to = mysqli_real_escape_string($conn, $_POST['assigned_to']);
    
    $check_member = mysqli_query($conn, "SELECT * FROM users WHERE id='$assigned_to' AND project_manager_id='$manager_id'");
    if(mysqli_num_rows($check_member) > 0){
        $sql = "INSERT INTO tasks (nama_tugas, deskripsi, project_id, assigned_to) 
                VALUES ('$nama_tugas', '$deskripsi', '$project_id', '$assigned_to')";
        mysqli_query($conn, $sql);
        $_SESSION['success'] = "Tugas berhasil ditambahkan!";
    } else {
        $_SESSION['error'] = "Error: Tidak bisa menugaskan ke member ini!";
    }
    header("Location: tasks.php");
    exit();
}

// Toggle edit mode
if (isset($_GET['edit'])) {
    $task_id = mysqli_real_escape_string($conn, $_GET['edit']);
    $verify_sql = "SELECT t.* FROM tasks t 
                JOIN projects p ON t.project_id = p.id 
                WHERE t.id='$task_id' AND p.manager_id='$manager_id'";
    $verify_result = mysqli_query($conn, $verify_sql);
    
    if(mysqli_num_rows($verify_result) == 1){
        $edit_mode = true;
        $editing_task = mysqli_fetch_assoc($verify_result);
    }
}

// Update tugas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_task'])) {
    $task_id = mysqli_real_escape_string($conn, $_POST['task_id']);
    $nama_tugas = mysqli_real_escape_string($conn, $_POST['nama_tugas']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $project_id = mysqli_real_escape_string($conn, $_POST['project_id']);
    $assigned_to = mysqli_real_escape_string($conn, $_POST['assigned_to']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    
    $check_member = mysqli_query($conn, "SELECT * FROM users WHERE id='$assigned_to' AND project_manager_id='$manager_id'");
    if(mysqli_num_rows($check_member) > 0){
        $sql = "UPDATE tasks SET 
                    nama_tugas='$nama_tugas',
                    deskripsi='$deskripsi',
                    project_id='$project_id',
                    assigned_to='$assigned_to',
                    status='$status'
                WHERE id='$task_id'";
        mysqli_query($conn, $sql);
        $_SESSION['success'] = "Tugas berhasil diupdate!";
    } else {
        $_SESSION['error'] = "Error: Tidak bisa menugaskan ke member ini!";
    }
    header("Location: tasks.php");
    exit();
}

// Hapus tugas
if (isset($_GET['delete'])) {
    $task_id = mysqli_real_escape_string($conn, $_GET['delete']);
    $verify_sql = "SELECT t.id FROM tasks t 
                JOIN projects p ON t.project_id = p.id 
                WHERE t.id='$task_id' AND p.manager_id='$manager_id'";
    $verify_result = mysqli_query($conn, $verify_sql);
    
    if(mysqli_num_rows($verify_result) == 1){
        mysqli_query($conn, "DELETE FROM tasks WHERE id='$task_id'");
        $_SESSION['success'] = "Tugas berhasil dihapus!";
    }
    header("Location: tasks.php");
    exit();
}

// Ambil semua tugas milik manager
$tasks_sql = "SELECT t.*, p.nama_proyek, u.username as assigned_name 
            FROM tasks t 
            JOIN projects p ON t.project_id = p.id 
            LEFT JOIN users u ON t.assigned_to = u.id 
            WHERE p.manager_id='$manager_id' 
            ORDER BY t.id DESC";
$tasks_result = mysqli_query($conn, $tasks_sql);
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kelola Tugas</h1>
</div>

<?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>
<?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<!-- FORM TAMBAH / EDIT TUGAS -->
<div class="card mb-4">
    <div class="card-header">
        <h5><?php echo $edit_mode ? 'Edit Tugas' : 'Tambah Tugas Baru'; ?></h5>
    </div>
    <div class="card-body">
        <form method="POST">
            <?php if($edit_mode): ?>
                <input type="hidden" name="task_id" value="<?php echo $editing_task['id']; ?>">
            <?php endif; ?>
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="nama_tugas" class="form-control" placeholder="Nama Tugas" 
                        value="<?php echo $edit_mode ? htmlspecialchars($editing_task['nama_tugas']) : ''; ?>" required>
                </div>
                <div class="col-md-3">
                    <select name="project_id" class="form-select" required>
                        <option value="">Pilih Proyek</option>
                        <?php foreach($projects as $project): ?>
                            <option value="<?php echo $project['id']; ?>" 
                                <?php echo ($edit_mode && $editing_task['project_id']==$project['id']) ? 'selected' : ''; ?>>
                                <?php echo $project['nama_proyek']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="assigned_to" class="form-select" required>
                        <option value="">Pilih Team Member</option>
                        <?php foreach($members as $member): ?>
                            <option value="<?php echo $member['id']; ?>" 
                                <?php echo ($edit_mode && $editing_task['assigned_to']==$member['id']) ? 'selected' : ''; ?>>
                                <?php echo $member['username']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select" required>
                        <?php 
                            $statuses = ['belum','proses','selesai'];
                            foreach($statuses as $s){
                                $selected = ($edit_mode && $editing_task['status']==$s) ? 'selected' : '';
                                echo "<option value='$s' $selected>".ucfirst($s)."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-12 mt-2">
                    <textarea name="deskripsi" class="form-control" placeholder="Deskripsi Tugas" rows="2"><?php echo $edit_mode ? htmlspecialchars($editing_task['deskripsi']) : ''; ?></textarea>
                </div>
                <div class="col-md-12 mt-2">
                    <?php if($edit_mode): ?>
                        <button type="submit" name="update_task" class="btn btn-success">Update Tugas</button>
                        <a href="tasks.php" class="btn btn-secondary">Batal</a>
                    <?php else: ?>
                        <button type="submit" name="add_task" class="btn btn-primary">Tambah Tugas</button>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- TABEL DAFTAR TUGAS -->
<div class="card">
    <div class="card-header">
        <h5>Daftar Tugas</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Tugas</th>
                        <th>Deskripsi</th>
                        <th>Proyek</th>
                        <th>Ditugaskan ke</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($task = mysqli_fetch_assoc($tasks_result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($task['nama_tugas']); ?></td>
                        <td><?php echo htmlspecialchars($task['deskripsi']); ?></td>
                        <td><?php echo htmlspecialchars($task['nama_proyek']); ?></td>
                        <td><?php echo htmlspecialchars($task['assigned_name']); ?></td>
                        <td>
                            <span class="badge bg-<?php 
                                switch($task['status']){
                                    case 'selesai': echo 'success'; break;
                                    case 'proses': echo 'warning'; break;
                                    default: echo 'secondary';
                                }
                            ?>">
                                <?php echo ucfirst($task['status']); ?>
                            </span>
                        </td>
                        <td>
                            <a href="?edit=<?php echo $task['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="?delete=<?php echo $task['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus tugas ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>