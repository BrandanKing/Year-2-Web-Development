export const userTable = {
    template:'#userTable',
    name:'userTable',
    data() {
        return {
            updateForm:false,
            addModal:false,
            deleteModal: false,
            currentStep: 1,
            maxSteps:4,
            url: 'http://localhost/coursework/',
            users: [],
            alcohol_questions:[],
            newUser: {
                firstname: '',
                surname: '',
                email: '',
                username: '',
                password: '',
                passwordCheck: '',
            },
            search: {
                text: ''
            },
            emptyResult: false,
            chooseUser: {},
            formValidate: [],
            successMSG: false,

            //pagination
            currentPage: 0,
            rowCountPage: 5,
            totalUsers: 0,
            pageRange: 2
        }
    },
    mounted() {
        this.showUsers();
        this.getQuestions();
        window.onclick = function (event) {
            if (!event.target.matches(".dropbtn")) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    openDropdown.classList.add("hidden");
                }
            }
        };
    },
    methods: {
        dropdownFunction(event) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            let list = event.currentTarget.parentElement.parentElement.getElementsByClassName("dropdown-content")[0];
            for (var i = 0; i < dropdowns.length; i++) {
                dropdowns[i].classList.add("hidden");
            }
            list.classList.toggle("hidden");
        },
        validateStep(step){
            var formData = this.formData(this.chooseUser);
            var v = this;
            axios.post(this.url+"users/validateStep/"+step, formData).then(function(response){
                if(response.data.error){
                    v.formValidate = response.data.msg;
                    console.log(v.chooseUser.allergy_details);
                }
                else{
                    v.currentStep += 1;
                    v.formValidate = false;
                }
            })
        },
        getQuestions() {
            var v = this;
            axios.get(this.url + "users/getAlcoholQuestions").then(function(response) {
                if (response.data.alcohol_questions == null) {
                    v.noResult();
                } 
                else {
                    v.alcohol_questions = response.data.alcohol_questions;
                }
            });
        },
        showUsers() {
            var v = this;
            axios.get(this.url + "users/showUsers").then(function(response) {
                if (response.data.users == null) {
                    v.noResult();
                } 
                else {
                    v.getData(response.data.users);
                }
            });
        },
        updateUser(){
            var formData = this.formData(this.chooseUser);
            var v = this;
            axios.post(this.url+"users/updateUser", formData).then(function(response){
                console.log(response.data);
                if(response.data.error){
                    v.formValidate = response.data.msg;
                }
                else{
                    v.successMSG = response.data.success;
                    v.clearAll();
                    v.clearMSG();
                }
            })
        },
        alterStatus(user, status) {
            var v = this;
            v.selectUser(user);
            v.chooseUser.status = status;
            var formData = v.formData(v.chooseUser);
            axios.post(this.url+"users/updateStatus", formData).then(function(response){
                if(response.data.error){
                    v.formValidate = response.data.msg;
                }
                else{
                    v.successMSG = response.data.success;
                    v.clearAll();
                    v.clearMSG();
                }
            })
        },
        searchUser(){
            var v = this;
            var formData = v.formData(v.search);
            axios.post(this.url+"users/searchUser", formData).then(function(response){
                if(response.data.users == null){
                    v.noResult()
                }
                else{
                    v.getData(response.data.users);   
                }  
            })
        },
        deleteUser() {
            var v = this;
            var formData = v.formData(v.chooseUser);
            axios.post(this.url + "users/deleteUser", formData).then(function(response) {
                if (!response.data.error) {
                    v.successMSG = response.data.success;
                    v.clearAll();
                    v.clearMSG();
                }
            })
        },
        addUser(){   
            var v = this;
            var formData = v.formData(v.newUser);
            axios.post(this.url+"users/addUser", formData).then(function(response){
                if(response.data.error){
                    v.formValidate = response.data.msg;
                }else{
                    v.successMSG = response.data.msg;
                    v.clearAll();
                    v.clearMSG();
                }
            })
        },
        // Select the specific user selected from the array
        selectUser(user) {
            this.chooseUser = user;
        },
        // Get the data in a formdata format
        formData(obj) {
            var formData = new FormData();
            for (var key in obj) {
                formData.append(key, obj[key] == null ? "" : obj[key] );
            }
            return formData;
        },
        getData(users) {
            this.emptyResult = false; // become false if has a record
            this.totalUsers = users.length //get total of user
            this.users = users.slice(this.currentPage * this.rowCountPage, (this.currentPage * this.rowCountPage) + this.rowCountPage); //slice the result for pagination
            // if the record is empty, go back a page
            if (this.users.length == 0 && this.currentPage > 0) {
                this.pageUpdate(v.currentPage - 1)
                this.clearAll();
            }
        },
        clearMSG(){
            setTimeout(() => this.successMSG = false, 2000)
        },
        clearAll() {
            this.newUser = {
                firstname: '',
                lastname: '',
                email: '',
                username: '',
                password: '',
                passwordCheck: '',
            };
            this.currentStep = 1;
            this.formValidate = false;
            this.addModal = false;
            this.updateForm = false;
            this.deleteModal = false;
            this.refresh()
        },
        noResult() {

            this.emptyResult = true; // become true if the record is empty, print 'No Record Found'
            this.users = null
            this.totalUsers = 0 //remove current page if is empty

        },
        pageUpdate(pageNumber) {
            this.currentPage = pageNumber; //receive currentPage number came from pagination template
            this.refresh()
        },
        refresh() {
            this.search.text ? this.searchUser() : this.showUsers(); //for preventing
        }
    }
};