<template>
    <div class="container">
       <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users</h3>

                
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                   
                    <th>Registered At</th>
                    <th>Modify</th>
                  </tr>
                  <tr v-for="user in users" :key="user.id" >
                    <td>{{user.id}}</td>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.created_at}}</td>
                    <td> 
                    <td> 
                        
                        <a href="#" @click="deleteUser(user.id)">
                            <i class="fas fa-trash-alt red"></i>
                            
                        </a>
                    </td>
                  </tr>
                  
                  
                   
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
          return {
            users: {},
            form: new Form({
                id: '',
                

                })
          }

        },
        methods: {
        loadUsers(){
          axios.get("/user").then(({data}) => {
            return (this.users=data.data);
          });
        },

        deleteUser(id) {

                       swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {


              this.form.delete("/delete/"+id).then(()=> {
            
                  swal.fire(
                    'Deleted!',
                    'User has been deleted.',
                    'success'
                  )
                  

            

              }).catch(()=>{

                  swal.fire("Failed","Something went wrong","warning");
              });
              
                
              })
            

        },
        },
        mounted() {
           this.loadUsers();
        }
    }
</script>
