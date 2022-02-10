<template id="userTable">
    <div class="userInfo relative">
        <div class="bg-white dark:bg-blackalt rounded-2xl shadow-xl w-full h-fit-content p-4 sm:p-6">

            <transition enter-active-class="animate__animated animate__fadeInDown" leave-active-class="animate__animated animate__fadeOutUp">
                <div class="absolute rounded-t w-full py-2 bg-green-400 left-0 top-0 text-white uppercase font-bold text-center" v-if="successMSG">{{successMSG}}</div>
            </transition>
            <transition enter-active-class="animate__animated animate__zoomIn" leave-active-class="animate__animated animate__zoomOut" mode='out-in' :duration="500">

                <div class="mx-auto" v-if="!updateForm">

                    <?php if ($this->session->userdata('isAdmin')) : ?>
                        <!-- Search Bar -->
                        <div class="relative text-lg bg-transparent text-brand dark:text-white  mb-3">
                            <div class="flex items-center border-b-2 border-brand dark:border-white pt-2">
                                <input placeholder="Search" type="search" v-model="search.text" @keyup="searchUser" name="search" class="bg-transparent border-none mr-3 px-2 leading-tight focus:outline-none w-full focus:shadow-none focus:ring-transparent">
                                <button type="submit" class="absolute right-0 top-1/2 transform -translate-y-1/2 mr-4">
                                    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                                        <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- User Table -->
                    <div class="w-full">
                        <table class="min-w-full bg-white dark:bg-blackalt block md:table font-montserrat shadow-lg md:shadow-none">
                            <thead class="hidden md:table-header-group">
                                <tr class="w-full h-16 bg-brand py-8">
                                    <th class="rounded-l-lg text-white font-bold pl-8 text-left tracking-normal leading-4 ">User</th>
                                    <th class="cursor-pointer text-white font-bold pr-6 text-left tracking-normal leading-4">Date of Birth</th>
                                    <th class="cursor-pointer text-white font-bold pr-6 text-left tracking-normal leading-4">Status</th>
                                    <th class="rounded-r-lg text-white font-bold pr-8 text-left tracking-normal leading-4">Action</th>
                                </tr>
                            </thead>
                            <tbody class="block md:table-row-group">
                                <tr v-for="user in users" class="border-brand dark:border-white border-none md:border-b md:border-solid block md:table-row md:h-20 text-center md:text-left">
                                    <td class="md:pl-8 block md:table-cell pb-3" data-label="User">
                                        <div>
                                            <p class="text-sm md:text-base text-brand dark:text-white">{{user.username}}</p>
                                            <p class="text-sm md:text-base text-brand dark:text-white">{{user.email}}</p>
                                        </div>
                                    </td>
                                    <td class="flex md:table-cell pb-3" data-label="Date of Birth">
                                        <p class="text-sm md:text-base text-brand dark:text-white">{{user.dob}}</p>
                                    </td>
                                    <td class="flex md:table-cell pb-3" data-label="Status">
                                        <div class="flex items-center">

                                            <svg width="20" height="20" :class="user.status">
                                                <use v-if="user.status" v-bind="{'xlink:href': '#' + user.status}"></use>
                                                <use v-else="user.status" xlink:href="#incomplete"></use>
                                            </svg>
                                            <p class="text-sm pl-2 font-bold text-brand dark:text-white capitalize">
                                                <span v-if="!user.status">Incomplete</span>
                                                <span v-else v-html="user.status"></span>
                                            </p>
                                        </div>
                                    </td>
                                    <td class="md:pr-8 relative flex md:table-cell pb-3" data-label="Action">
                                        <?php if ($this->session->userdata('isAdmin')) : ?>
                                            <div class="dropdown-content mt-8 absolute left-2/4 md:left-0 md:-ml-12 shadow-md z-10 hidden w-32">
                                                <ul class="bg-white dark:bg-brand shadow rounded py-1">
                                                    <li class="cursor-pointer text-brand dark:text-white py-3 hover:bg-brand hover:text-white px-3 font-normal" @click="updateForm = true; selectUser(user)">Edit</li>
                                                    <li class="cursor-pointer text-brand dark:text-white py-3 hover:bg-brand hover:text-white px-3 font-normal" @click="deleteModal = true; selectUser(user)">Delete</li>

                                                    <li v-if="user.status" class="cursor-pointer text-green-400 dark:text-white py-3 hover:bg-green-400 hover:text-white px-3 font-normal" @click="alterStatus(user, 'approved')">Approve</li>
                                                    <li v-if="user.status" class="cursor-pointer text-tomato-500 dark:text-white py-3 hover:bg-tomato-500 hover:text-white px-3 font-normal" @click="alterStatus(user, 'rejected')">Reject</li>
                                                </ul>
                                            </div>
                                            <button class="text-brand dark:text-white rounded cursor-pointer border border-transparent focus:outline-none dropbtn" @click="dropdownFunction($event)">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dots dropbtn" width="50" height="20" viewBox="0 0 24 24" stroke-width="7" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                                    <circle class="dropbtn" cx="-5" cy="12" r="1"></circle>
                                                    <circle class="dropbtn" cx="10" cy="12" r="1"></circle>
                                                    <circle class="dropbtn" cx="25" cy="12" r="1"></circle>
                                                </svg>
                                            </button>
                                        <?php else : ?>
                                            <button class="transform hover:scale-105 motion-reduce:transform-none focus:outline-none bg-green-400 transition duration-150 text-white ease-in-out rounded px-4 sm:px-8 py-2 my-5 text-xs sm:text-sm font-bold" @click="updateForm = true; selectUser(user)">Edit</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <?php if ($this->session->userdata('isAdmin')) : ?>
                        <button class="transform hover:scale-105 motion-reduce:transform-none focus:outline-none bg-green-400 transition duration-150 text-white ease-in-out rounded px-4 sm:px-8 py-2 my-5 text-xs sm:text-sm font-bold" @click="addModal = true">Add User</button>
                        <pagination :current_page="currentPage" :row_count_page="rowCountPage" @page-update="pageUpdate" :total_users="totalUsers" :page_range="pageRange"></pagination>
                    <?php endif; ?>

                    <!--delete modal-->
                    <modal v-if="deleteModal" @close="clearAll()">

                        <div class="w-full flex justify-center text-red-500 mb-4" slot="head">
                            <svg width="56" height="56">
                                <use xlink:href="#rejected"></use>
                            </svg>
                        </div>

                        <div slot="body">
                            <h4 class="text-center text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">Do you want to delete this record?</h4>
                        </div>

                        <div slot="foot">
                            <button class="transform hover:scale-105 motion-reduce:transform-none focus:outline-none transition duration-150 ease-in-out hover:bg-tomato-500 bg-tomato-700 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm" @click="deleteModal = false; deleteUser()">Delete</button>
                            <button class="transform hover:scale-105 motion-reduce:transform-none focus:outline-none ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-4 sm:px-8 py-2 text-xs sm:text-sm" @click="deleteModal = false">Cancel</button>
                        </div>

                    </modal>

                    <!--Add modal-->
                    <modal v-if="addModal" @close="clearAll()">

                        <div class="w-full mb-4" slot="head">
                            <h4 class="font-montserrat font-bold text-lg text-brand dark:text-white mb-4">Add New User</h4>
                        </div>

                        <form id="registerForm" v-on:submit.prevent slot="body">
                            <div class="sm:flex flex-wrap justify-between w-full">

                                <div class="sm:w-1/2 px-3 flex flex-col mb-3">
                                    <label for="firstname" class="pb-2 text-sm font-bold text-brand dark:text-white">First Name*</label>
                                    <input type="text" name="firstname" v-model="newUser.firstname" :class="{' border-red-400': formValidate.firstname}" class="border border-gray-300 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent focus:border-gray-300" placeholder="First Name*" />
                                    <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.firstname">
                                        <p class="text-xs" v-html="formValidate.firstname"></p>
                                        <svg width="16" height="16">
                                            <use xlink:href="#rejected"></use>
                                        </svg>
                                    </div>
                                </div>

                                <div class="sm:w-1/2 px-3 flex flex-col mb-3">
                                    <label for="surname" class="pb-2 text-sm font-bold text-brand dark:text-white">Surname*</label>
                                    <input type="text" name="surname" v-model="newUser.surname" :class="{' border-red-400': formValidate.surname}" class="border border-gray-300 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent focus:border-gray-300" placeholder="Surname*" />
                                    <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.surname">
                                        <p class="text-xs" v-html="formValidate.surname"></p>
                                        <svg width="16" height="16">
                                            <use xlink:href="#rejected"></use>
                                        </svg>
                                    </div>
                                </div>

                                <div class="sm:w-1/2 px-3 flex flex-col mb-3">
                                    <label for="email" class="pb-2 text-sm font-bold text-brand dark:text-white">Email*</label>
                                    <div class="relative">
                                        <div class="absolute text-brand dark:text-white flex items-center px-4 border-r h-full">
                                            <svg width="20" height="20">
                                                <use xlink:href="#email"></use>
                                            </svg>
                                        </div>
                                        <input type="text" name="email" v-model="newUser.email" :class="{' border-red-400': formValidate.email}" class="border w-full border-gray-300 pl-16 py-3 shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent focus:border-gray-300" placeholder="Email*" />
                                    </div>
                                    <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.email">
                                        <p class="text-xs" v-html="formValidate.email"></p>
                                        <svg width="16" height="16">
                                            <use xlink:href="#rejected"></use>
                                        </svg>
                                    </div>
                                </div>

                                <div class="sm:w-1/2 px-3 flex flex-col mb-3">
                                    <label for="username" class="pb-2 text-sm font-bold text-brand dark:text-white">Username*</label>
                                    <input type="text" name="username" v-model="newUser.username" :class="{' border-red-400': formValidate.username}" class="border border-gray-300 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent focus:border-gray-300" placeholder="Username*" />
                                    <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.username">
                                        <p class="text-xs" v-html="formValidate.username"></p>
                                        <svg width="16" height="16">
                                            <use xlink:href="#rejected"></use>
                                        </svg>
                                    </div>
                                </div>

                                <div class="sm:w-1/2 px-3 flex flex-col mb-3">
                                    <label for="password" class="pb-2 text-sm font-bold text-brand dark:text-white">Password*</label>
                                    <input type="password" name="password" v-model="newUser.password" :class="{' border-red-400': formValidate.password}" class="border border-gray-300 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent focus:border-gray-300" placeholder="Password*" />
                                    <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.password">
                                        <p class="text-xs" v-html="formValidate.password"></p>
                                        <svg width="16" height="16">
                                            <use xlink:href="#rejected"></use>
                                        </svg>
                                    </div>
                                </div>

                                <div class="sm:w-1/2 px-3 flex flex-col mb-3">
                                    <label for="passwordCheck" class="pb-2 text-sm font-bold text-brand dark:text-white">Confirm Password*</label>
                                    <input type="password" name="passwordCheck" v-model="newUser.passwordCheck" :class="{' border-red-400': formValidate.passwordCheck}" class="border border-gray-300 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent focus:border-gray-300" placeholder="Confirm Password*" />
                                    <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.passwordCheck">
                                        <p class="text-xs" v-html="formValidate.passwordCheck"></p>
                                        <svg width="16" height="16">
                                            <use xlink:href="#rejected"></use>
                                        </svg>
                                    </div>
                                </div>

                            </div>
                            <div class="w-full flex justify-center">
                                <button class="transform hover:scale-105 motion-reduce:transform-none shadow bg-gradient-to-bl from-royalblue-400 to-brand focus:shadow-outline focus:outline-none text-white font-bold py-2 px-10 rounded" type="submit" @click="addUser()">Add</button>
                            </div>
                        </form>

                    </modal>
                </div>

                <?php include APPPATH . 'views/templates/userForm.php'; ?>
            </transition>
        </div>
    </div>
</template>