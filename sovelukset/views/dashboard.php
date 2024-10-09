<?php
include 'pää.php';
include 'sivu.php';


?>

<div class="content">
    <div class="container-fluid">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="card bg-white shadow-md rounded-lg p-6">
                <div class="header">
                    <h4 class="title text-xl font-semibold">Email Statistics</h4>
                    <p class="category text-gray-600">Last Campaign Performance</p>
                </div>
                <div class="content mt-4">
                    <canvas id="emailStatisticsChart"></canvas>
                    <div class="footer mt-4">
                        <div class="legend flex justify-between text-gray-600">
                            <span><i class="fa fa-circle text-blue-500"></i> Open</span>
                            <span><i class="fa fa-circle text-red-500"></i> Bounce</span>
                            <span><i class="fa fa-circle text-yellow-500"></i> Unsubscribe</span>
                        </div>
                        <hr class="my-2">
                        <div class="stats text-gray-600">
                            <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                        </div>
                    </div>
                </div>
            </div>

            <div class="card bg-white shadow-md rounded-lg p-6 col-span-2">
                <div class="header">
                    <h4 class="title text-xl font-semibold">Users Behavior</h4>
                    <p class="category text-gray-600">24 Hours performance</p>
                </div>
                <div class="content mt-4">
                    <canvas id="userBehaviorChart"></canvas>
                    <div class="footer mt-4">
                        <div class="legend flex justify-between text-gray-600">
                            <span><i class="fa fa-circle text-blue-500"></i> Open</span>
                            <span><i class="fa fa-circle text-red-500"></i> Click</span>
                            <span><i class="fa fa-circle text-yellow-500"></i> Click Second Time</span>
                        </div>
                        <hr class="my-2">
                        <div class="stats text-gray-600">
                            <i class="fa fa-history"></i> Updated 3 minutes ago
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
            <div class="card bg-white shadow-md rounded-lg p-6">
                <div class="header">
                    <h4 class="title text-xl font-semibold">2014 Sales</h4>
                    <p class="category text-gray-600">All products including Taxes</p>
                </div>
                <div class="content mt-4">
                    <canvas id="salesChart"></canvas>
                    <div class="footer mt-4">
                        <div class="legend flex justify-between text-gray-600">
                            <span><i class="fa fa-circle text-blue-500"></i> Tesla Model S</span>
                            <span><i class="fa fa-circle text-red-500"></i> BMW 5 Series</span>
                        </div>
                        <hr class="my-2">
                        <div class="stats text-gray-600">
                            <i class="fa fa-check"></i> Data information certified
                        </div>
                    </div>
                </div>
            </div>

            <div class="card bg-white shadow-md rounded-lg p-6">
                <div class="header">
                    <h4 class="title text-xl font-semibold">Tasks</h4>
                    <p class="category text-gray-600">Backend development</p>
                </div>
                <div class="content mt-4">
                    <table class="table-auto w-full">
                        <tbody>
                            <tr>
                                <td class="border px-4 py-2">
                                    <input type="checkbox" id="checkbox1">
                                    <label for="checkbox1" class="ml-2">Sign contract for "What are conference organizers afraid of?"</label>
                                </td>
                                <td class="border px-4 py-2 text-right">
                                    <button class="text-blue-500 hover:text-blue-700"><i class="fa fa-edit"></i></button>
                                    <button class="text-red-500 hover:text-red-700"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">
                                    <input type="checkbox" id="checkbox2" checked>
                                    <label for="checkbox2" class="ml-2">Lines From Great Russian Literature? Or E-mails From My Boss?</label>
                                </td>
                                <td class="border px-4 py-2 text-right">
                                    <button class="text-blue-500 hover:text-blue-700"><i class="fa fa-edit"></i></button>
                                    <button class="text-red-500 hover:text-red-700"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">
                                    <input type="checkbox" id="checkbox3">
                                    <label for="checkbox3" class="ml-2">Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit</label>
                                </td>
                                <td class="border px-4 py-2 text-right">
                                    <button class="text-blue-500 hover:text-blue-700"><i class="fa fa-edit"></i></button>
                                    <button class="text-red-500 hover:text-red-700"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">
                                    <input type="checkbox" id="checkbox4" checked>
                                    <label for="checkbox4" class="ml-2">Create 4 Invisible User Experiences you Never Knew About</label>
                                </td>
                                <td class="border px-4 py-2 text-right">
                                    <button class="text-blue-500 hover:text-blue-700"><i class="fa fa-edit"></i></button>
                                    <button class="text-red-500 hover:text-red-700"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">
                                    <input type="checkbox" id="checkbox5">
                                    <label for="checkbox5" class="ml-2">Read "Following makes Medium better"</label>
                                </td>
                                <td class="border px-4 py-2 text-right">
                                    <button class="text-blue-500 hover:text-blue-700"><i class="fa fa-edit"></i></button>
                                    <button class="text-red-500 hover:text-red-700"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">
                                    <input type="checkbox" id="checkbox6" checked>
                                    <label for="checkbox6" class="ml-2">Unfollow 5 enemies from twitter</label>
                                </td>
                                <td class="border px-4 py-2 text-right">
                                    <button class="text-blue-500 hover:text-blue-700"><i class="fa fa-edit"></i></button>
                                    <button class="text-red-500 hover:text-red-700"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="footer mt-4">
                        <hr class="my-2">
                        <div class="stats text-gray-600">
                            <i class="fa fa-history"></i> Updated 3 minutes ago
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer mt-6 py-4 bg-gray-200">
    <div class="container mx-auto px-4">
        <nav class="flex justify-between">
            <ul class="flex space-x-4">
                <li><a href="#" class="text-blue-500 hover:underline">Home</a></li>
                <li><a href="#" class="text-blue-500 hover:underline">Company</a></li>
                <li><a href="#" class="text-blue-500 hover:underline">Portfolio</a></li>
                <li><a href="#" class="text-blue-500 hover:underline">Blog</a></li>
            </ul>
            <p class="text-gray-600">&copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com" class="text-blue-500 hover:underline">Creative Tim</a>, made with love for a better web</p>
        </nav>
    </div>
</footer>

<?php
include 'alatunniste.php';


?>
<script src="../js/dashboard.js"></script>
