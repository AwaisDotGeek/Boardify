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
                                Already have an account?
                                <RouterLink class="link" to="/login">
                                    Log in
                                </RouterLink>
                                instead.
                            </p>
                        </div>

                    </form>
                </div>
        </div>
        <div class="success-message-container" :class="{'inactive': !isSuccessActive}">
            <h2>{{ successText }}</h2>
            <Button @click="changeBtnText()">
                <template v-slot:btn-value>
                    {{ buttonText }}
                </template>
            </Button>
        </div>
        <div :class="{'loader-container': isLoadingActive, 'inactive': !isLoadingActive}">
            <span class="loader"></span>
            <h5>Creating Account..</h5>
        </div>
    </div>
</template>

<script>
    /* eslint-disable no-unused-vars */
    import axios from 'axios';
    import Button from './components/Button.vue';
    export default {
        data() {
            return {
                email: '',
                username: '',
                password1: '',
                password2: '',

                isSuccessActive: false,
                isLoadingActive: false,
                buttonText: 'OK',
                successText: 'Your account has been created. Check your email!',

                /* If there was any errors, following 
                    variables would be used to show error messages */
                emailError: '',
                usernameError: '',
                passwordError: '',
                passwordErrorShown: false,
            }
        },

        components: {
            Button,
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
                this.isLoadingActive = true;
                try {
                    const response = await axios.post('/api/register', {
                        name: this.username,
                        email: this.email,
                        password: this.password1,
                    });

                    if (response) {

                        if (response.data.emailError || response.data.usernameError) {
                            setTimeout(() => {
                                this.emailError = response.data.emailError;
                                this.usernameError = response.data.usernameError;
                                this.isLoadingActive = false;
                            }, 1500);
                            return;
                        }

                        this.isLoadingActive = false;
                        this.isSuccessActive = true;
                        setTimeout(() => {
                            this.isSuccessActive = false;

                            this.$router.push({
                                name: 'EmailVerification',
                                params: { user_id: this.formatUserIdToEightDigits(response.data.user.user_id) },
                            });
                        }, 5000);
                    }

                } catch (error) {
                    this.isLoadingActive = false;
                    // alert(error.message);
                }
            },

            formatUserIdToEightDigits(userId) {
                // Convert the input number to a string and pad it with leading zeros
                const formattedUserId = String(userId).padStart(8, '0');

                // Ensure the formatted number is at most 8 characters long
                return formattedUserId.slice(-8);
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
            },

            changeBtnText() {
                this.buttonText = 'Redirecting to verification page ';
                setInterval(() => {
                    this.buttonText += '.';
                    if (this.buttonText === 'Redirecting to verification page ....') {
                        this.buttonText = 'Redirecting to verification page ';
                    }
                }, 500);
            },

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

    .success-message-container {
        background: #212b2a;
        height: 150px;
        padding: 25px;
        border-radius: 20px;
        display: flex;
        flex-direction: column;
        gap: 15px;
        justify-content: center;
        box-shadow: 0 0 10px 0 #fff;

        position: absolute;
    }

    .inactive {
        display: none;
    }

    .success-message-container > h2 {
        color: #fff;
    }
    
    .loader-container {
        position: absolute;
        height: 150px;
        width: 250px;
        background: #212b2a;
        box-shadow: 0 0 10px 0 #fff;
        border-radius: 15px;

        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 10px;
    }

    h5 {
        color: #fff;
    }

    .loader {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: inline-block;
        border-top: 4px solid #FFF;
        border-right: 4px solid transparent;
        box-sizing: border-box;
        animation: rotation 1s linear infinite;
    }
    .loader::after {
        content: '';  
        box-sizing: border-box;
        position: absolute;
        left: 0;
        top: 0;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border-left: 4px solid #FF3D00;
        border-bottom: 4px solid transparent;
        animation: rotation 0.5s linear infinite reverse;
    }
    
    @keyframes rotation {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    } 
</style>