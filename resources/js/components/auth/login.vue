<template>
    <div class="hold-transition login-page">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="javascript:void(0);" class="h1" v-once><b>IP MANAGEMENT</b></a><br>
                </div>
                <div class="card-body">
                    <p class="login-box-msg" v-once>Sign in to start your session</p>

                    <small class="text-danger" v-if="errors">Please check your login credentials.</small>
                    <form class="user" @submit.prevent="login">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                placeholder="Enter Username" v-model="form.username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="exampleInputPassword"
                                placeholder="Enter Password" v-model="form.password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <hr>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
@import "../../../../public/backend2/dist/css/adminlte.min.css";
</style>

<script>
import axios from 'axios'; // Import axios library
import User from '../../Helpers/User'; // Import User helper
import Toast from 'your-toast-library'; // Import Toast library

export default {
    created() {
        // Initialize any data or make API calls on component creation
    },

    data() {
        return {
            form: {
                username: null,
                password: null,
            },
            errors: false,
            img: require('../../../../backend2/premier.jpg') // Use require for image path
        }
    },
    methods: {
        login() {
            axios.post('/api/auth/login', this.form)
                .then(res => {
                    // Check if login is successful
                    if (res.data.success) {
                        this.errors = false; // Reset errors
                        User.responseAfterLogin(res.data); // Handle user data after login
                        Toast.fire({
                            icon: 'success',
                            title: 'Signed-in Successfully'
                        });
                        this.$router.push('/manage_session'); // Navigate to manage session page
                    } else {
                        this.errors = true; // Show error message
                    }
                })
                .catch(error => {
                    console.error('Login failed:', error);
                    this.errors = true; // Show error message
                });
        }
    },
}
</script>

<style></style>
