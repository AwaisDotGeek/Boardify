<template>
    <div class="main">
        <div class="container">
            <div class="form-left-img-container">
                <img src="./assets/bg.png" alt="">
                <div class="img-shadow"></div>
            </div>
            <div class="form-container">
                <form action="" @submit.prevent="validateData">
                    <h1>Login</h1>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" placeholder="email here" v-model="email">
                        <span class="error-msg">{{ emailError }}</span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-field-container">
                            <input type="password" placeholder="password here" v-model="password">
                            <i class="fa-regular fa-eye" style="color: #000000;" @click="handleEyeClick"></i>
                        </div>
                        <span class="error-msg">{{ passwordError }}</span>
                    </div>
                    <div class="form-group">
                        <RouterLink class="link" to="/reset-password">forgot password ?</RouterLink>
                        <input type="submit" value="Login">
                    </div>
                    <div class="signup-option">
                        <p>
                            don't have account? 
                            <RouterLink class="link" to="/signup">
                                Signup
                            </RouterLink>
                            now
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <MessageCard :msgText="msgText" :btnText = "btnText" :isMsgCardActive = "isMsgCardAcive"></MessageCard>
        <LoaderCard :loaderText = "'Loading'" :isLoaderCardAcive = "isLoaderCardAcive"></LoaderCard>
    </div>
</template>

<script>
    import axios from 'axios';
    import MessageCard from './components/MessageCard.vue';
    import LoaderCard from './components/LoaderCard.vue';
    export default {
        components: {
            MessageCard,
            LoaderCard,
        },    
        data() {
            return {
                email: '',
                password: '',

                // Msg Card
                btnText: 'OK',
                msgText: "",
                isMsgCardAcive: false,

                // Loader Card
                loaderText: "Loading ...",
                isLoaderCardAcive: true,

                emailError: '',
                passwordError: '',
            } 
        },
        methods: {
            validateData() {
                this.validateEmail(this.email);
                this.validatePassword(this.password);

                if (this.emailError.trim() == '' && this.passwordError.trim() == '') {
                    this.submitData();    
                }
            },
        
            // Email validation
            validateEmail(email) {
                let errorMsg = "";
                if (email === '') {
                    errorMsg = "Email field cannot be empty!";
                } else if (!email.includes("@gmail.com")) {
                    errorMsg = "Email must end with '@gmail.com' !";
                }

                this.emailError = errorMsg;
            },

            validatePassword(password) {
                let errorMsg = "";
                if (password === '') {
                    errorMsg = "password cannot be empty!";
                } 

                this.passwordError = errorMsg;
            },

            async submitData() {
                try {
                    const response = await axios.post('/login', {
                        email: this.email,
                        password: this.password,
                    });

                    if (response) {
                        if (response.data.message) {
                            this.passwordError = response.data.message;
                        } else if (!response.data.email_verified) {
                            alert("Your email is not verified!");
                        }
                    }

                    // try {
                    //     if (response.data.message) {
                    //         this.passwordError = response.data.message;
                    //         return;
                    //     }
                    // } catch (error) {
                    //     console.log(error);
                    //     return;
                    // }

                    // this.$router.push('/');
                } catch (error) {
                    console.log(error.response.data);
                }
            },

            handleEyeClick(e) {
                // console.log(e);
                // console.log(e.target);
                if (e.target.classList.contains('fa-eye')) {
                    e.target.classList.remove('fa-eye');
                    e.target.classList.add('fa-eye-slash');
                    e.target.previousSibling.type = "text";
                } else {
                    e.target.classList.add('fa-eye');
                    e.target.classList.remove('fa-eye-slash');
                    e.target.previousSibling.type = "password";
                }
            }
            
        }
    }
</script>

<style scoped>

    .main {
        width: 100vw;
        height: 100vh;
        display: grid;
        place-items: center;
    }
    .form-group:nth-child(4) {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        margin-top: 15px;
    }

    .signup-option {
        margin-top: 15px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }
</style>