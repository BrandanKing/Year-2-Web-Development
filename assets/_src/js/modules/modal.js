export const modal = Vue.component('modal',{ //modal
    template:
    `
        <transition enter-active-class="animated zoomIn" leave-active-class="animated zoomOut">
            <div class="py-12 bg-black z-50 transition duration-150 ease-in-out fixed top-0 right-0 bottom-0 left-0 items-center justify-center flex bg-opacity-70" id="modal">
                <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-2xl">
                    <div class="relative py-8 px-8 md:px-16 bg-white shadow-md rounded border border-gray-400">
                    
                        <slot name="head"></slot>
                        <slot name="body"></slot>
                        
                        <div class="flex items-center justify-center w-full">
                            <slot name="foot"></slot>
                        </div>

                        <div class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out" @click="$emit('close')">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-label="Close" class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                        </div>

                    </div>
                </div>
            </div>
        </transition>
    `,
});