<div class="flex flex-no-wrap min-h-screen bg-gray-100 dark:bg-brand" id="app">
    <navigation inline-template>
        <div>
            <div class="w-64 z-50 fixed bg-brand dark:bg-blackalt shadow lg:shadow-none flex-col justify-between lg:relative transition duration-150 ease-in-out transform -translate-x-64 lg:translate-x-0 h-full" id="mobile-nav">

                <div id="openSideBar" class="h-6 w-6 bg-tomato-500 absolute right-0 mt-16 -mr-6 flex items-center shadow rounded-tr rounded-br justify-center cursor-pointer lg:hidden" @click="sidebarHandler()">

                    <svg class="icon icon-tabler icon-tabler-adjustments fill-current text-white transform" :class="{' rotate-180': !moved}" width="20" height="20">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                </div>

                <div class="lg:sticky top-0">
                    <div class="w-full flex items-center py-4">
                        <svg class="w-16 h-16 mx-auto">
                            <use xlink:href="#logo"></use>
                        </svg>
                    </div>

                    <nav class="relative ml-4 mb-5">
                        <span class="absolute h-10 w-full bg-white rounded-l-2xl ease-out transition-transform transition-medium" :style="{ transform: `translateY(calc(100% * ${selected}))` }"></span>
                        <ul class="relative">
                            <li>
                                <button type="button" @click='select(0); setComponent("welcomeMessage");' :aria-selected="selected === 0" class="py-2 px-3 w-full flex items-center focus:outline-none focus-visible:underline">
                                    <svg :class="selected === 0 ? 'text-tomato-500' : 'text-white'" class="h-6 w-6 transition-all ease-out transition-medium" viewBox="0 0 24 24" fill="currentColor">
                                        <use xlink:href="#home"></use>
                                    </svg>
                                    <span :class="selected === 0 ? 'text-tomato-500' : 'text-white'" class="ml-2 text-sm font-montserrat font-bold transition-all ease-out transition-medium">
                                        Home
                                    </span>
                                </button>
                            </li>
                            <li>
                                <button type="button" @click='select(1); setComponent("userTable");' :aria-selected="selected === 1" class="py-2 px-3 w-full flex items-center focus:outline-none focus-visible:underline">
                                    <svg :class="selected === 1 ? 'text-tomato-500' : 'text-white'" class="h-6 w-6 transition-all ease-out transition-medium" viewBox="0 0 24 24" fill="currentColor">
                                        <use xlink:href="#users"></use>
                                    </svg>
                                    <span :class="selected === 1 ? 'text-tomato-500' : 'text-white'" class="ml-2 text-sm font-montserrat font-bold transition-all ease-out transition-medium">
                                        <?= $this->session->userdata('isAdmin') ? 'Patients' : 'My Questionnaire'; ?>
                                    </span>
                                </button>
                            </li>
                            <?php if ($this->session->userdata('isAdmin')) : ?>
                                <li>
                                    <button type="button" @click='select(2); setComponent("dataGraphs");' :aria-selected="selected === 2" class="py-2 px-3 w-full flex items-center focus:outline-none focus-visible:underline">
                                        <svg :class="selected === 2 ? 'text-tomato-500' : 'text-white'" class="h-6 w-6 transition-all ease-out transition-medium" viewBox="0 0 24 24" fill="currentColor">
                                            <use xlink:href="#charts"></use>
                                        </svg>
                                        <span :class="selected === 2 ? 'text-tomato-500' : 'text-white'" class="ml-2 text-sm font-montserrat font-bold transition-all ease-out transition-medium">
                                            Charts
                                        </span>
                                    </button>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a class="py-2 px-3 w-full flex items-center focus:outline-none focus-visible:underline" href="<?= base_url(); ?>auth/logout">
                                    <svg class="h-6 w-6 transition-all ease-out transition-medium" viewBox="0 0 24 24" fill="currentColor">
                                        <use xlink:href="#logout"></use>
                                    </svg>
                                    <span class="ml-2 text-sm font-montserrat font-bold transition-all ease-out transition-medium text-white">
                                        Logout
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>

            <div class="bg-gray-800 opacity-60 w-full h-full fixed z-40" v-if="!moved"></div>
        </div>
    </navigation>

    <div class="py-10 justify-center flex w-full">
        <div class="md:w-11/12 w-11/12">

            <h1 class="font-montserrat font-bold lg:text-4xl text-2xl text-brand dark:text-royalblue-400 mb-4">J&S Medical Practice dashboard</h1>

            <label for="toogleA" class="flex items-center cursor-pointer fixed sm:top-4 sm:bottom-auto bottom-4 right-0 rounded-l bg-gray-100 p-4 z-30 shadow-lg">
                <div class="inline-block mr-3">
                    <svg class="w-6 h-6 mx-auto text-brand dark:text-royalblue-400">
                        <use xlink:href="#light"></use>
                    </svg>
                </div>
                <div class="relative">
                    <input id="toogleA" type="checkbox" class="hidden" @click="toggleDarkMode" v-model="theme" />
                    <div class="w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                    <div class="toggle__dot absolute w-6 h-6 bg-white rounded-full shadow inset-y-0 left-0"></div>
                </div>

                <div class="inline-block ml-3">
                    <svg class="w-6 h-6 mx-auto text-brand dark:text-royalblue-400">
                        <use xlink:href="#dark"></use>
                    </svg>
                </div>
            </label>

            <transition enter-active-class="animate__animated animate__zoomIn" leave-active-class="animate__animated animate__zoomOut" mode='out-in' :duration="500">
                <keep-alive>
                    <component :is="currentComponent"></component>
                </keep-alive>
            </transition>

        </div>
    </div>

</div>