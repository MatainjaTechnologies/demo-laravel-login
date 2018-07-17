<template>
    <div class="register_box">
        <div class="alert alert-danger" v-if="error && !success">
            <p>There was an error, unable to complete registration.</p>
        </div>
        <div class="alert alert-success" v-if="success">
            <p>Registration completed. You can now>sign in.</router-link></p>
        </div>
        <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" v-model="name" required>
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label for="Mobile">Mobile</label>
                <input type="mobile" id="mobile" class="form-control" placeholder="" v-model="mobile" required>
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="password" required>
                <span class="help-block"></span>
            </div>
             
            
            
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
</template>

<script> 
    export default {
        data(){
            return {
                name: '',
                email: '',
                mobile: '',
                password: '',
                error: false,
                errors: {},
                success: false
            };
        },
        methods: {
            register(){
                var app = this
                this.$auth.register({
                    params: {
                        name: app.name,
                        email: app.email,
                        mobile:app.mobile,
                        password: app.password
                        
                    }, 
                    success: function () {
                       app.success = true
                    },
                    error: function (resp) {
                        app.error = true;
                        app.errors = resp.response.data.errors;
                    },
                    redirect: null
                });                
            }
        }
    }
</script>