<?php require './script/header.php'; ?>

<body>


    <div class="container" id="app">
        <h1>{{text}}</h1>
            <a href="index.php"><button class="btn btn-warning">Back</button></a>
            <form @submit.prevent="submitForm" ref="CreateForm">
                <div class="form-group">
                    <label for="FirstName">FirstName</label>
                    <input type="text" class="form-control" v-model="users.fname" placeholder="FirstName" required>
                </div>
                <div class="form-group">
                    <label for="LastName">LastName</label>
                    <input type="text" class="form-control" v-model="users.lname" placeholder="LastName" required>
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" v-model="users.email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Avatar</label>
                    <input type="text" class="form-control" v-model="users.avatar" placeholder="Avatar" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>


<?php require './script/script.php'; ?>
<?php require './script/footer.php'; ?>

</body>

<script>

    new Vue({
                el: "#app",
                data() {
                    return {

                        "text": "Create new users",

                        users: {

                            fname : '',
                            lname : '',
                            email : '',
                            avatar : '',

                               },
                    }
                },
                methods: {
                    submitForm() {
                        
                        axios.post('Api/user/create.php', this.users)
                            .then(response => {
                                console.log(response);
                                if(response.data.status == 'ok'){
                                    alert('create success');
                                    this.$refs.CreateForm.reset();
                                }
                            })
                            .catch(error => {
                                console.log(error);
                            });
                    }

                }
                })

</script>