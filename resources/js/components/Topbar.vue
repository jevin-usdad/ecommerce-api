<template>
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
        <div class="px-3 py-3 lg:px-5 lg:pl-3 flex justify-between items-center">

            <!-- LEFT -->
            <div class="flex items-center">
                <button
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100">
                    ☰
                </button>

                <router-link to="/list" class="ml-3 text-xl font-bold">
                    LOGO
                </router-link>
            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-3">
                <img class="w-8 h-8 rounded-full cursor-pointer"
                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="profile" />
            </div>

        </div>
    </nav>
</template>


