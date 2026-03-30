
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit;
}

include "../tugas_praktimum/config.php";

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM events WHERE id=$id");
    header("Location: admin_dashboard.php");
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $organizer = $_POST['organizer'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("INSERT INTO events (title, date, organizer, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $date, $organizer, $status);
    $stmt->execute();

    header("Location: admin_dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../tugas_praktimum/">
    <script src="web.js"></script>
</head>


<body class="bg-gray-100 min-h-screen">
<div class="flex">

    <aside
        class="w-64 bg-card-bg-dark p-6 min-h-screen border-r border-gray-700 sticky top-0"
      >
        <h1 class="font-title text-2xl text-primary mb-10">Admin Village</h1>
        <nav class="space-y-3">
          <a
            href="?page=dashboard"
            id="link-dashboard"
            onclick="loadContent('dashboard')"
            class="sidebar-link flex items-center space-x-3 p-3 rounded-lg transition"
          >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"
              ></path>
            </svg>
            <span>Dashboard Overview</span>
          </a>
          <a
            href="?page=event" 
            id="link-event-crud"
            onclick="loadContent('event-crud')"
            class="sidebar-link flex items-center space-x-3 p-3 rounded-lg transition"
          >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17.414 14A2 2 0 0015 12.586V10a2 2 0 00-2-2h-3v3a2 2 0 01-2 2H5a2 2 0 01-2-2v-3H2a1 1 0 00-1 1v4a1 1 0 001 1h16a1 1 0 001-1v-4a1 1 0 00-1-1z"
              ></path>
            </svg>
            <span>Manajemen Event (CRUD)</span>
          </a>
          <a
            href=#
            id="link-user-role"
            onclick="loadContent('user-role')"
            class="sidebar-link flex items-center space-x-3 p-3 rounded-lg text-gray-400 hover:bg-gray-700 transition"
          >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 15a2 2 0 11-4 0v3h4v-3zM16 15h2v-3a2 2 0 00-2-2z"
              ></path>
            </svg>
            <span>User & Role Access (belom jadi)</span>
          </a>
          <a
            href="#"
            id="link-finance"
            onclick="loadContent('finance')"
            class="sidebar-link flex items-center space-x-3 p-3 rounded-lg text-gray-400 hover:bg-gray-700 transition"
          >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zM10 12a1 1 0 01-1-1V9a1 1 0 112 0v2a1 1 0 01-1 1zM13 12a1 1 0 01-1-1V9a1 1 0 112 0v2a1 1 0 01-1 1zM7 12a1 1 0 01-1-1V9a1 1 0 112 0v2a1 1 0 01-1 1z"
              ></path>
            </svg>
            <span>Finance & Ticketing (belom jadi)</span>
          </a>

          <hr class="my-2 border-gray-700" />

          <a
            href="#"
            id="link-region-stats"
            onclick="loadContent('region-stats')"
            class="sidebar-link flex items-center space-x-3 p-3 rounded-lg text-gray-400 hover:bg-gray-700 transition"
          >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path
                fill-rule="evenodd"
                d="M12 1.586l4 4V14a2 2 0 01-2 2h-4a2 2 0 01-2-2V7.586l4-4zM10 16v-2a2 2 0 00-2-2H5a2 2 0 00-2 2v2h7zm-5-3a1 1 0 011-1h4a1 1 0 110 2H6a1 1 0 01-1-1z"
                clip-rule="evenodd"
              ></path>
            </svg>
            <span>Geografi & Statistik Daerah (belom jadi)</span>
          </a>
        </nav>
      </aside>

    <div class="flex-1 p-8">

        <?php
        $page = $_GET['page'] ?? 'dashboard';
        if ($page == 'dashboard') {
?>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

  <div class="bg-white p-5 rounded-xl shadow-md border-b-4 border-yellow-600">
    <p class="text-sm text-gray-500">Total Event Aktif</p>
    <p class="text-3xl mt-1 font-bold">
      <?php
      $total = $conn->query("SELECT COUNT(*) as total FROM events WHERE status='Aktif'")->fetch_assoc();
      echo $total['total'];
      ?>
    </p>
  </div>

  <div class="bg-white p-5 rounded-xl shadow-md border-b-4 border-green-500">
    <p class="text-sm text-gray-500">Pendaftar Baru (7 hari)</p>
    <p class="text-3xl mt-1 font-bold">271</p>
  </div>

  <div class="bg-white p-5 rounded-xl shadow-md border-b-4 border-red-500">
    <p class="text-sm text-gray-500">Menunggu Approval</p>
    <p class="text-3xl mt-1 font-bold">
      <?php
      $pending = $conn->query("SELECT COUNT(*) as total FROM events WHERE status='Draft'")->fetch_assoc();
      echo $pending['total'];
      ?>
    </p>
  </div>

  <div class="bg-white p-5 rounded-xl shadow-md border-b-4 border-blue-500">
    <p class="text-sm text-gray-500">Total Transaksi</p>
    <p class="text-3xl mt-1 font-bold">Rp 271.000</p>
  </div>

</div>

<div class="bg-white p-6 rounded-xl shadow-lg">
  <h2 class="text-xl mb-4 font-semibold">Event Approval & Moderasi</h2>

  <table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-100">
      <tr>
        <th class="px-6 py-3 text-left text-xs uppercase">Acara</th>
        <th class="px-6 py-3 text-left text-xs uppercase">Penyelenggara</th>
        <th class="px-6 py-3 text-left text-xs uppercase">Status</th>
        <th class="px-6 py-3 text-right text-xs uppercase">Aksi</th>
      </tr>
    </thead>

    <tbody class="divide-y">
    <?php
    $result = $conn->query("SELECT * FROM events ORDER BY id DESC LIMIT 5");

    while ($row = $result->fetch_assoc()) {
        $statusColor = $row['status'] == 'Aktif'
            ? "bg-green-100 text-green-800"
            : "bg-yellow-100 text-yellow-800";

        echo "
        <tr>
          <td class='px-6 py-4'>{$row['title']}</td>
          <td class='px-6 py-4'>{$row['organizer']}</td>
          <td class='px-6 py-4'>
            <span class='px-2 rounded-full text-xs $statusColor'>
              {$row['status']}
            </span>
          </td>
          <td class='px-6 py-4 text-right space-x-2'>
            <a href='?page=event&delete={$row['id']}' class='text-red-500'>Hapus</a>
          </td>
        </tr>
        ";
    }
    ?>
    </tbody>
  </table>
</div>
<div class="bg-white p-6 rounded-xl shadow-lg mt-8">
  <h2 class="text-xl mb-4 font-semibold">Dashboard Analytics</h2>
  <div class="h-64 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">
    Chart Coming Soon 🚀
  </div>
</div>

<?php
}

        if ($page == 'event') :
        ?>

        <h1 class="text-3xl mb-6 font-bold">Manajemen Event</h1>
        <div class="bg-white p-6 rounded-xl shadow mb-6">
            <h2 class="text-xl mb-4 font-semibold">Tambah Event</h2>

            <form method="POST" class="grid grid-cols-2 gap-4">
                <input type="text" name="title" placeholder="Judul Event" required class="p-2 border rounded">
                <input type="date" name="date" required class="p-2 border rounded">

                <input type="text" name="organizer" placeholder="Penyelenggara" required class="p-2 border rounded">
                
                <select name="status" class="p-2 border rounded">
                    <option value="Aktif">Aktif</option>
                    <option value="Draft">Draft</option>
                </select>

                <button type="submit" name="submit" class="col-span-2 bg-amber-600 text-white p-2 rounded hover:bg-amber-700">
                    Tambah Event
                </button>
            </form>
        </div>
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-xl mb-4 font-semibold">Daftar Event</h2>

            <table class="w-full border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2">Judul</th>
                        <th class="p-2">Tanggal</th>
                        <th class="p-2">Penyelenggara</th>
                        <th class="p-2">Status</th>
                        <th class="p-2">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                $result = $conn->query("SELECT * FROM events");

                if ($result->num_rows == 0) {
                    echo "<tr><td colspan='5' class='text-center p-4'>Data kosong</td></tr>";
                }

                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr class='text-center border-t'>
                        <td class='p-2'>{$row['title']}</td>
                        <td class='p-2'>{$row['date']}</td>
                        <td class='p-2'>{$row['organizer']}</td>
                        <td class='p-2'>{$row['status']}</td>
                        <td class='p-2'>
                            <a href='?page=event&delete={$row['id']}' 
                               class='text-red-500 hover:underline'
                               onclick='return confirm(\"Yakin hapus?\")'>
                               Hapus
                            </a>
                        </td>
                    </tr>
                    ";
                }
                ?>
                </tbody>
            </table>
        </div>

        <?php endif; ?>

    </div>
</div>

</body>
</html>