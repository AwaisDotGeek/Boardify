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
                <div class="re-code-container">
                    <span class="re-code" @click="getCodeAgain">Get another code</span>
                    <span :class="{ 're-code-wait': shouldWaitMore}" style="transition: all 0.05s ease-in-out;">{{ timer }}</span>
                </div>
                <button type="submit">Submit</button>
            </form>
            <span style="color: #ccc; max-width: 300px; display: inline-block; white-space: wrap;">
                <strong style="color: #eee;">Note:</strong>
                Please also check your spam folder if you can't find email in your inbox.
            </span>
        </div>

        <MessageCard :msgText="msgText" :msgText2="msgText2" :isMsgCardActive="isMsgCardActive"></MessageCard>
        <LoaderCard :loaderText="loaderText" :isLoaderCardActive="isLoaderCardActive"></LoaderCard>
    </div>
</template>

<script>
import axios from 'axios';
import LoaderCard from './components/LoaderCard.vue';
import MessageCard from './components/MessageCard.vue';
export default {
    props: ['user_id'],
    components: {
        LoaderCard,
        MessageCard,
    },
    data() {
        return {
            verificationCode: "",
            verificationCodeError: "",

            timer: 30,
            shouldWaitMore: false,

            // Message card
            msgText: '',
            msgText2: "",
            isMsgCardActive: false,

            // Loader card
            loaderText: "",
            isLoaderCardActive: false,
        };
    },
    mounted() {
        setTimeout(() => {
            setInterval(() => {
                if (this.timer > 0) {
                    this.timer--;
                } 
            }, 1000);
        }, 1000);
    },  
    methods: {
        async submitVerificationCode() {
            this.loaderText = "Verifying";
            this.isLoaderCardActive = true;
            try {
                const response = await axios.post('/api/verify-email', {
                    userId: this.user_id,
                    verificationCode: this.verificationCode,
                });

                if (response) {
                    if (!response.data.success) {
                        setTimeout(() => {
                            this.verificationCodeError = response.data.message;
                            this.isLoaderCardActive = false;
                        }, 1500);
                    } else {
                        // hide loader
                        setTimeout(() => {
                            this.isLoaderCardActive = false;

                            this.msgText = "Email verification was Successful";
                            this.msgText2 = "Redirecting you to home page";
                            this.isMsgCardActive = true;
                        }, 1500);
                        setTimeout(() => {
                            this.isMsgCardActive = false;
                            this.$router.push('/boardify-home');
                        }, 4500);
                    }
                }

            } catch (error) {
                console.log(error.message);
            }
        },

        getCodeAgain() {
            if (this.timer > 0) {
                let myInterval = null;
                myInterval = setInterval(() => {
                    this.shouldWaitMore = !this.shouldWaitMore;
                }, 200);
                
                setTimeout(() => {
                    clearInterval(myInterval);
                    this.shouldWaitMore = false;
                }, 2000);
            } else {
                this.timer = 60;
                this.requestCode();
            }
        }, 

        async requestCode() {
            try {
                const response = await axios.post('/api/get-verification-code', {
                    userId: this.user_id,
                });
                if (response) {
                    this.msgText = response.data.message;
                    this.isMsgCardActive = true;
                    setTimeout(() => {
                        this.isMsgCardActive = false;
                    }, 2000);
                }
            } catch (error) {
                alert(error);
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

    .re-code-container {
        display: flex;
        justify-content: space-between;

        padding-bottom: 10px;
        color: #ccc;
    }

    .re-code:hover {
        color: #fff;
        cursor: pointer;
    }

    .re-code:active {
        transform: translateY(2px);
    }

    .re-code-wait {
        font-weight: bolder;
        color: #fff;
        letter-spacing: 2px;
    }

</style>
