export function loginPage() {
    // Create register form component
    const registerComponent = {
        template:'#registerTemplate',
        name:'RegisterComponent',
        data() {
            return {
                url: 'http://localhost/coursework/',
                user: {
                    firstname: '',
                    surname: '',
                    email: '',
                    username: '',
                    password: '',
                    passwordCheck: '',
                },
                formValidate: [],
            }
        },
        methods: {
            // Create call to the register controller to see if the user passes validation and if so then log them in
            register(){   
                var v = this;
                var formData = v.formData(v.user);
                axios.post(this.url+"auth/register", formData).then(function(response){
                    if(response.data.error){
                        v.formValidate = response.data.msg;
                    }
                    else{
                        window.location.href = v.url + "dashboard";
                    }
                })
            },
            formData(obj) {
                var formData = new FormData();
                for (var key in obj) {
                    formData.append(key, obj[key]);
                }
                return formData;
            },
        }
    }

    // Create register form component
    const loginComponent = {
        template:'#loginTemplate',
        name:'loginComponent',
        data() {
            return {
                url: 'http://localhost/coursework/',
                user: {
                    username: '',
                    password: '',
                },
                formValidate: [],
            }
        },
        methods: {
            // Create call to the login controller to see if the user passes validation and if so then log them in
            loginUser(){
                var v = this;
                var formData = v.formData(v.user);
                axios.post(this.url+"auth/loginUser", formData).then(function(response){
                    if(response.data.error){
                        v.formValidate = response.data.msg;
                    }
                    else{
                        window.location.href = v.url + "dashboard";
                    }
                })
            },
            formData(obj) {
                var formData = new FormData();
                for (var key in obj) {
                    formData.append(key, obj[key]);
                }
                return formData;
            },
        }
    }

    var element =  document.getElementById('authPopup');
    // Double check to see if authPopup exists to prevent JS error
    if (typeof(element) != 'undefined' && element != null){

        new Vue({
            el:'#authPopup',
            components:{
                register:registerComponent,
                login:loginComponent
            },
            name:'authenticationPopUp',
            data () {
                return {
                    currentComponent:'login'
                }
            },
            methods: {
                isDisabled (btnName) {
                    return (this.currentComponent === btnName)
                },
                setComponent(componentName) {
                    if (this.currentComponent !== componentName) {
                        this.currentComponent = componentName
                    }
                }
            }
        });

    }
}
