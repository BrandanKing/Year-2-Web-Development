import { loginPage } from "./modules/login";
import { nav } from "./modules/nav";
import { pagination } from "./modules/pagination";
import { modal } from "./modules/modal";
import { userTable } from "./modules/userTable";
import { dataGraphs } from "./modules/graphs";

(function() {
    loginPage();
    
    const welcomeMessage = {
        template:'#welcomeMessage',
        name:'welcomeMessage',
    };
    
    // Create dashboard app
    var app =  document.getElementById('app');
    if (typeof(app) != 'undefined' && app != null){
        new Vue({
            el:'#app',
            components:{
                welcomeMessage:welcomeMessage,
                userTable:userTable,
                dataGraphs:dataGraphs
            },
            data () {
                return {
                    theme: localStorage.theme ? 'checked' : '',
                    currentComponent:'welcomeMessage',
                }
            },
            created(){
                // Check to see what theme the user last used and toggle this
                if(localStorage.theme){
                    document.documentElement.classList.add(localStorage.theme);
                }
            },
            methods: {
                // Toggle the darkmode colours
                toggleDarkMode(){
                    var checkBox = document.getElementById("toogleA");
                    if (checkBox.checked == true){
                        localStorage.theme = 'dark';
                        document.documentElement.classList.add(localStorage.theme);
                    } else {
                        localStorage.removeItem('theme')
                        document.documentElement.classList.remove('dark');
                    }
                },
                setComponent(componentName) {
                    if (this.currentComponent !== componentName) {
                        this.currentComponent = componentName
                    }
                }
            }
        });
    }

})();