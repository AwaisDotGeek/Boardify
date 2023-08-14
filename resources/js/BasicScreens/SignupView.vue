<template>
    <div class="main">
        <div class="container">
                <div class="form-left-img-container">
                    <img src="./assets/bg.png" alt="">
                    <div class="img-shadow"></div>
                </div>
                <div class="form-container">
                    <form action="" @submit.prevent="validateData">
                    
                        <h1>Sign up</h1>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" placeholder="Email here" name="email" v-model="email" autocomplete="email">
                            <!-- following span element is used to show errors if any -->
                            <span class="error-msg">{{ emailError }}</span>
                        </div>
                    
                        <div class="form-group">
                            <label for="username">Username 
                                <sub style="font-size: small; color: #eee;">
                                    your in-game name
                                </sub>
                            </label>
                            <input type="text" placeholder="Username here" name="username" v-model="username" autocomplete="username">
                            <span class="error-msg">{{ usernameError }}</span>
                        </div> 
                    
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="password-field-container">
                                <input type="password" placeholder="Password here" name="password1" v-model="password1" autocomplete="new-password">
                                <i class="fa-regular fa-eye" style="color: #000000;" @click="handleEyeClick"></i>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label for="password">Repeat Password</label>
                            <div class="password-field-container">
                                <input type="password" placeholder="Repeat Password here" name="password2" v-model="password2" autocomplete="new-password">
                                <i class="fa-regular fa-eye" style="color: #000000;" @click="handleEyeClick"></i>
                            </div>
                            <span class="error-msg" id="password-error">{{ passwordError }}</span>
                        </div>
                    
                        <div class="form-group">
                            <input type="submit" value="Signup">
                        </div>
                    
                        <div class="login-option">
                            <p>
                                got an account? 
                                <RouterLink class="link" to="/login">
                                    Login
                                </RouterLink>
                                instead
                            </p>
                        </div>

                    </form>
                </div>
        </div>
    </div>
</template>

<script>
    /* eslint-disable no-unused-vars */
    import axios from 'axios';
    export default {
        data() {
            return {
                email: '',
                username: '',
                password1: '',
                password2: '',

                /* If there was any errors, following 
                    variables would be used to show error messages */
                emailError: '',
                usernameError: '',
                passwordError: '',
                passwordErrorShown: false,
            }
        },

        methods: {
            validateData() {
                this.validateEmail(this.email);
                this.validateUserName(this.username);
                this.validatePassword(this.password1, this.password2);

                if (this.emailError.trim() == '' && this.usernameError.trim() == '' && this.passwordError.trim() == '' && !this.passwordErrorShown)
                {
                    this.submitData();
                }
            },

            // Email validation
            validateEmail(email) {
                if (email.trim() === '') {
                    this.emailError = "Email field cannot be empty!";
                } else if (!email.endsWith("@gmail.com")) {
                    this.emailError = "Email must end with '@gmail.com'!";
                } else {
                    this.emailError = '';
                }
            },

            // Validate username
            validateUserName(username) {
                this.usernameError = username.trim() === '' ? "Username cannot be empty!" : '';
            },

            // Validate password
            validatePassword(pass1, pass2) {
                const passwordRegex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*[0-9]).{8,15}$/;
                if (pass1.trim() === '' || pass2.trim() === '') {
                    this.passwordError = "One or both password fields are empty!";
                } else if (pass1 !== pass2) {
                    this.passwordError = "Passwords do not match!";
                } else if (!passwordRegex.test(pass1)) {
                    // this.passwordError = ''; 
                    document.querySelector("#password-error").innerHTML = `Password must be: <br />
                        - at least 8 characters long <br />
                        - must contain at least 1 uppercase letter <br />
                        - a special character and a number`;
                    this.passwordErrorShown = true;
                } else {
                    this.passwordError = '';
                    this.passwordErrorShown = false;
                }
            },


            async submitData() {
                try {
                    const response = await axios.post('/api/register', {
                        name: this.username,
                        email: this.email,
                        password: this.password1,
                    });

                    this.$router.push('/login');
                } catch (error) {
                    // alert(response.data.message);
                    // console.log(error.response);
                    this.emailError = error.response.data.emailError;
                    this.usernameError = error.response.data.usernameError;
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
    .form-group {
        margin-bottom: 5px;
    }
    
</style>