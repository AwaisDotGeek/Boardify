<template>
    <div class="container">
            <div class="form-left-img-container">
                <img src="./assets/bg.png" alt="">
                <div class="img-shadow"></div>
            </div>
            <div class="form-container">
                <form v-if="!showNewPassword" action="" @submit.prevent="validateEm">
                    <h1>Reset Password</h1>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" placeholder="Enter your email" v-model="email">
                        <span class="error-msg">{{ emailError }}</span>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Check">
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
</template>

<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                email: '',
                password: '',
                emailError: '',
                passwordErrorShown: '',
                showNewPassword: false
            }
        }, 

        methods: {
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
                try {
                    const response = await axios.post('/api/check-email', {
                        email: this.email,
                    });
                    if (response.data.exists) {
                        this.showNewPassword = true;
                    } else {
                        this.emailError = 'Email not found in records!';
                    }
                } catch (error) {
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

                    alert(response.data.message);
                    this.$router.push('/');
                } catch (error) {
                    console.log(error);
                }
            }
        }
    }
</script>

<style>
</style>