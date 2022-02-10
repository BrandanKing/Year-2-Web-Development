<div class="min-h-screen py-6 flex flex-col justify-center items-center sm:py-12 bg-brand px-4">
    <div class="relative py-3 md:max-w-2xl sm:max-w-2xl mx-w-xl">
        <div class="relative px-4 py-10 bg-white rounded-3xl sm:p-10">

            <div id="authPopup" v-cloak>

                <div class="actions pb-3 text-center">
                    <button class="shadow bg-gradient-to-br from-orange-200 to-tomato-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded transition duration-500 ease-in-out" :class='[{ "opacity-25": !isDisabled("login") }]' @click.prevent='setComponent("login")'>Login</button>
                    <button class="shadow bg-gradient-to-br  from-orange-200 to-tomato-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded transition duration-500 ease-in-out" :class='[{ "opacity-25": !isDisabled("register") }]' @click.prevent='setComponent("register")'>Register</button>
                </div>

                <transition name='form' mode='out-in' enter-active-class="animate__animated animate__fadeIn" leave-active-class="animate__animated animate__fadeOut">
                    <keep-alive>
                        <component :is="currentComponent"></component>
                    </keep-alive>
                </transition>

            </div>

        </div>
    </div>
</div>

<template id="registerTemplate">
    <form id="registerForm" v-on:submit.prevent>
        <div class="sm:flex flex-wrap justify-between w-full">

            <div class="sm:w-1/2 px-3 flex flex-col mb-3">
                <label for="firstname" class="pb-2 text-sm font-bold text-brand">First Name*</label>
                <input type="text" name="firstname" v-model="user.firstname" :class="{' border-red-400': formValidate.firstname}" class="border border-gray-300 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent focus:border-gray-300" placeholder="First Name*" />
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.firstname">
                    <p class="text-xs" v-html="formValidate.firstname"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>

            <div class="sm:w-1/2 px-3 flex flex-col mb-3">
                <label for="surname" class="pb-2 text-sm font-bold text-brand">Surname*</label>
                <input type="text" name="surname" v-model="user.surname" :class="{' border-red-400': formValidate.surname}" class="border border-gray-300 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent focus:border-gray-300" placeholder="Surname*" />
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.surname">
                    <p class="text-xs" v-html="formValidate.surname"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>

            <div class="sm:w-1/2 px-3 flex flex-col mb-3">
                <label for="email" class="pb-2 text-sm font-bold text-brand">Email*</label>
                <div class="relative">
                    <div class="absolute text-brand flex items-center px-4 border-r h-full">
                        <svg width="20" height="20">
                            <use xlink:href="#email"></use>
                        </svg>
                    </div>
                    <input type="text" name="email" v-model="user.email" :class="{' border-red-400': formValidate.email}" class="border w-full border-gray-300 pl-16 py-3 shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent focus:border-gray-300" placeholder="Email*" />
                </div>
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.email">
                    <p class="text-xs" v-html="formValidate.email"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>

            <div class="sm:w-1/2 px-3 flex flex-col mb-3">
                <label for="username" class="pb-2 text-sm font-bold text-brand">Username*</label>
                <input type="text" name="username" v-model="user.username" :class="{' border-red-400': formValidate.username}" class="border border-gray-300 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent focus:border-gray-300" placeholder="Username*" />
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.username">
                    <p class="text-xs" v-html="formValidate.username"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>

            <div class="sm:w-1/2 px-3 flex flex-col mb-3">
                <label for="password" class="pb-2 text-sm font-bold text-brand">Password*</label>
                <input type="password" name="password" v-model="user.password" :class="{' border-red-400': formValidate.password}" class="border border-gray-300 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent focus:border-gray-300" placeholder="Password*" />
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.password">
                    <p class="text-xs" v-html="formValidate.password"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>

            <div class="sm:w-1/2 px-3 flex flex-col mb-3">
                <label for="passwordCheck" class="pb-2 text-sm font-bold text-brand">Confirm Password*</label>
                <input type="password" name="passwordCheck" v-model="user.passwordCheck" :class="{' border-red-400': formValidate.passwordCheck}" class="border border-gray-300 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent focus:border-gray-300" placeholder="Confirm Password*" />
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.passwordCheck">
                    <p class="text-xs" v-html="formValidate.passwordCheck"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>

        </div>
        <div class="w-full flex justify-center">
            <button class="transform hover:scale-105 motion-reduce:transform-none shadow bg-gradient-to-bl from-royalblue-400 to-brand focus:shadow-outline focus:outline-none text-white font-bold py-2 px-10 rounded" type="submit" @click="register">Register</button>
        </div>
    </form>
</template>

<template id="loginTemplate">
    <form id="loginForm" v-on:submit.prevent>
        <div class="text-white px-6 py-4 border-0 rounded mb-4 bg-red-400 text-center" v-if="formValidate.login_failed">
            <p v-html="formValidate.login_failed"></p>
        </div>
        <div class="sm:flex flex-wrap justify-between w-full">
            <div class="w-full px-3 flex flex-col mb-3">
                <label for="username" class="pb-2 text-sm font-bold text-brand">Username*</label>
                <input type="text" name="username" v-model="user.username" :class="{' border-red-400': formValidate.username}" class="border border-gray-300 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent focus:border-gray-300" placeholder="Username*" autocomplete />
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.username">
                    <p class="text-xs" v-html="formValidate.username"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>
            <div class="w-full px-3 flex flex-col mb-3">
                <label for="password" class="pb-2 text-sm font-bold text-brand">Password*</label>
                <input type="password" v-model="user.password" name="password" :class="{' border-red-400': formValidate.password}" class="border border-gray-300 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent focus:border-gray-300" placeholder="Password*" autocomplete />
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.password">
                    <p class="text-xs" v-html="formValidate.password"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>
        </div>
        <div class="w-full flex justify-center">
            <button class="transform hover:scale-105 motion-reduce:transform-none shadow bg-gradient-to-bl from-royalblue-400 to-brand focus:shadow-outline focus:outline-none text-white font-bold py-2 px-10 rounded" type="submit" @click="loginUser">Login</button>
        </div>
    </form>
</template>