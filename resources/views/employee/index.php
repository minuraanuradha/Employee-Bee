<?php
// Dummy fallback values
$userName = $_SESSION['user_name'] ?? 'John Doe';
$userRole = $_SESSION['role'] ?? 'Employee';
$profilePic = $_SESSION['profile_pic'] ?? 'assets/images/default-user.png';
?>
<div class="w-full h-full p-2 bg-stone-950 ">
    <div class="w-full flex items-center space-x-4">
        <!-- Profile Picture Area -->
        <div class="w-3/12 h-72 rounded-md p-4 bg-cover bg-center relative overflow-hidden propic"
            style="background-image: url('<?php echo $profilePic; ?>');">
            <!-- Blurred Overlay -->
            <div class="absolute inset-0 backdrop-blur-sm bg-black/50 z-0 rounded-md"></div>

            <!-- Content over blurred area -->
            <div class="relative z-10 text-white">
                <h2 class="text-xl font-bold mb-1"><?php echo $userName; ?></h2>
                <p class="text-sm italic"><?php echo ucfirst($userRole); ?></p>
            </div>
        </div>

        <!-- Welcome Area -->
        <div class="flex flex-col w-full h-72 space-y-2">
            <div class="w-full h-1/2 rounded-lg p-4 bg-stone-950 flex flex-col justify-center">
                <p class="p-4 text-white font-bold text-3xl flex">
                    Welcome, <?php echo ucfirst($userRole); ?>!<br>
                </p>
                <p class="p-4 text-white font-bold text-3xl flex">
                    User ID: <?php echo $_SESSION['user_id'] ?? 'Not logged in'; ?>
                </p>
            </div>
            <div class="w-full h-1/2 rounded-lg p-4 bg-stone-950 flex flex-col justify-center">
                <p class="p-4 text-white font-bold text-3xl flex">
                    Welcome, <?php echo ucfirst($userRole); ?>!<br>
                    User ID: <?php echo $_SESSION['user_id'] ?? 'Not logged in'; ?>
                </p>
            </div>
        </div>

    </div>
</div>