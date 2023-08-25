<template>
    <div class="main">
        <div class="verification-form">
            <h1>Verify Email</h1>
            <form @submit.prevent="submitVerificationCode">
                <div class="input-container">
                    <label for="verification-code">Verification Code:</label>
                    <input type="text" name="verification-code" v-model="verificationCode" placeholder="Enter verification code"
                        required />
                    <span class="error-msg">{{ verificationCodeError }}</span>
                </div>
                <button type="submit">Submit</button>
            </form>
            <span style="color: #ccc; max-width: 300px; display: inline-block; white-space: wrap;">
                <strong style="color: #eee;">Note:</strong>
                Please also check your spam folder if you can't find mail in your inbox.
            </span>

        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props: ['user_id'],
    data() {
        return {
            verificationCode: "",
            verificationCodeError: "",
        };
    },
    methods: {
        async submitVerificationCode() {
            try {
                const response = await axios.post('/api/verify-email', {
                    userId: this.user_id,
                    verificationCode: this.verificationCode,
                });

                if (response) {
                    if (!response.data.success) {
                        this.verificationCodeError = response.data.message;
                    } else {
                        this.$router.push('/boardify-home');
                    }
                }

            } catch (error) {
                console.log(error.message);
            }
        }
    }
};
</script>

<style scoped>

    .main {
        height: 100%;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    form {
        gap: 0;
    }
    .verification-form {
        min-width: 350px;
        margin: 0 auto;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 5px 0 #fff;
        text-align: center;
    }

    h1 {
        margin-bottom: 20px;
        color: #fff;
    }

    .input-container {
        margin-bottom: 15px;
        text-align: left;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #fff;
    }

    input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        background-color: #030f11;
        font-size: 16px;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    button:hover {
        transform: translateY(-2px);
        background-color: #212b2a;
    }

    button:active {
        transform: translateY(2px);
    }
</style>
