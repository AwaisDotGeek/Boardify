<template>
    <div class="main">
        <div class="container">
            <div class="form-left-img-container">
                <img src="./assets/bg.png" alt="">
                <div class="img-shadow"></div>
            </div>

            <div class="form-container">
                <form v-if="!showNewPassword" action="" @submit.prevent="submitForm">
                    <h1>Reset Password</h1>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" placeholder="Enter your email" v-model="email" :disabled="emailFieldDisabled">
                        <span class="error-msg">{{ emailError }}</span>
                    </div>
                    <div v-if="emailFoundInRecords" class="form-group">
                        <label for="verification">Verification Code</label>
                        <input type="text" placeholder="Enter the verification code" v-model="verificationCode">
                        <span class="error-msg">{{ verificationCodeError }}</span>
                    </div>
                    <div class="form-group">
                        <input type="submit" :value="submitBtnValue">
                    </div>
                    <div class="login-option">
                        <p>
                            remember password? 
                            <RouterLink class="link" to="/login">
                                Login
                            </RouterLink>
                            now
                        </p>
                    </div>
                </form>

                <form v-if="showNewPassword" action="" @submit.prevent="validatePass">
                    <h1>Reset Password</h1>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input v-model="password" type="text" placeholder="Enter new password">
                        <span class="error-msg" id="password-error"></span>
                        <input type="submit" value="Change" style="margin-top: 10px;">
                    </div>
                    <div class="login-option">
                        <p>
                            remember password? 
                            <RouterLink class="link" to="/login">
                                Login
                            </RouterLink>
                            now
                        </p>
                    </div>
                </form>
            </div>
        </div>
        <MessageCard :msgText="msgText" :msgText2="msgText2" :isMsgCardActive="isMsgCardActive"></MessageCard>
        <LoaderCard :loaderText="loaderText" :isLoaderCardActive="isLoaderCardActive"></LoaderCard>
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
                emailError: '',
                passwordErrorShown: '',
                showNewPassword: false,

                verificationCode: '',
                emailFoundInRecords: false,
                verificationCodeError: '',
                submitBtnValue: 'Check',
                emailFieldDisabled: false,
                userId: '',

                // Msg Card
                msgText: '',
                msgText2: "",
                isMsgCardActive: false,

                // Loader Card
                loaderText: "",
                isLoaderCardActive: false,
            }
        }, 

        methods: {
            submitForm() {
                if (!this.emailFieldDisabled) {
                    this.validateEm();
                } else {
                    this.validateVerificationCode();
                }
            },    
            validateEm() {
                this.validateEmail(this.email);
                if (this.emailError.trim() == '') {
                    this.checkEmailExistance();
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

            async checkEmailExistance() {
                this.loaderText = "Looking for Account";
                this.isLoaderCardActive = true;
                try {
                    const response = await axios.post('/api/check-email', {
                        email: this.email,
                    });
                    if (response.data.user_id >= 0) {
                        this.userId = response.data.user_id.toString().padStart(8, '0');
                        setTimeout(() => {
                            this.loaderText = 'Account found';
                        }, 1000);
                        this.requestCode();
                    } else {
                        setTimeout(() => {
                            this.isLoaderCardActive = false;
                            this.emailError = 'Email not found in records!';
                        }, 1500);
                    }
                } catch (error) {
                    this.isLoaderCardActive = false;
                    this.emailError = "An error occured while checking email!";
                    console.log(error);
                }
            },

            validatePass() {
                this.validatePassword(this.password);
                if (!this.passwordErrorShown) {
                    this.resetPassword();
                }
            },

            validatePassword(password) {
                const passwordRegex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*[0-9]).{8,15}$/;
                if (!passwordRegex.test(password)) {
                    alert(password);
                    document.querySelector("#password-error").innerHTML = `Password must be: <br />
                            - at least 8 characters long <br />
                            - must contain at least 1 uppercase letter <br />
                            - a special character and a number`;
                    this.passwordErrorShown = true;
                } else {
                    document.querySelector("#password-error").innerHTML = '';
                    this.passwordErrorShown = false;
                }
            },

            async resetPassword() {
                try {
                    const response = await axios.post('/api/reset-password', {
                        email: this.email,
                        password: this.password,
                    });

                    this.msgText = "Password changed successfully!";
                    this.isMsgCardActive = true;
                    setTimeout(() => {
                        this.isMsgCardActive = false;
                        this.$router.push('/login');
                    }, 1500);
                } catch (error) {
                    console.log(error);
                }
            },

            async requestCode() {
                setTimeout(() => {
                    this.loaderText = 'Sending verification code';
                }, 3000);
                try {
                    const response = await axios.post('/api/get-verification-code', {
                        userId: this.userId,
                    });
                    if (response) {
                        this.isLoaderCardActive = false;
                        this.msgText = response.data.message;
                        this.isMsgCardActive = true;
                        setTimeout(() => {
                            this.isMsgCardActive = false;
                            this.emailFoundInRecords = true;
                            this.submitBtnValue = 'Verify';
                            this.emailFieldDisabled = true;
                            this.isLoaderCardActive = false;
                        }, 1500);
                    }
                } catch (error) {
                    alert(error);
                }
            },

            validateVerificationCode() {
                const regex = /^\d{1,6}$/;
                if (this.verificationCode.trim() === '') {
                    this.verificationCodeError = 'Please enter verification code!';
                } else if (!regex.test(this.verificationCode)) {
                    this.verificationCodeError = "Only numbers are allowed! [max -> 6]"
                } else {
                    this.verificationCodeError = '';
                    this.submitVerificationCode();
                }
            },

            async submitVerificationCode() {
                this.loaderText = "Verifying";
                this.isLoaderCardActive = true;
                try {
                    const response = await axios.post('/api/verify-email', {
                        userId: this.userId,
                        verificationCode: this.verificationCode,
                    });
                    if (response) {
                        if (!response.data.success) {
                            this.verificationCodeError = response.data.message;
                            this.isLoaderCardActive = false;
                        } else {
                            setTimeout(() => {
                                this.isLoaderCardActive = false;
                                this.showNewPassword = true;
                            }, 1500);
                        }
                    }
                } catch (error) {
                    console.log(error);
                }
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
</style>