<template>
    <div class="container">
       <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Portfolios</h3>

                
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Overview</th>
                    <th>Project URL</th>
                   
                  </tr>
                  <tr v-for="portfolio in portfolios" :key="portfolio.id" >
                    <td>{{portfolio.id}}</td>
                    <td>{{portfolio.user_id}}</td>
                    <td>{{portfolio.overview}}</td>
                    <td>{{portfolio.project_url}}</td>
                    
                    
                     
                    <!-- <td> 
                        
                        <a href="#" @click="deleteUser(user.id)">
                            <i class="fas fa-trash-alt red"></i>
                            
                        </a>
                    </td> -->
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
            portfolios: {},
            form: new Form({
                id: '',
                

                })
          }

        },
        methods: {
        loadPortfolios(){
          axios.get("/api/portfolio").then(({data}) => {
            return (this.portfolios=data.data);
          });
        },

        // deleteUser(id) {

        //                swal.fire({
        //         title: 'Are you sure?',
        //         text: "You won't be able to revert this!",
        //         type: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, delete it!'
        //       }).then((result) => {


        //       this.form.delete("/delete/"+id).then(()=> {
            
        //           swal.fire(
        //             'Deleted!',
        //             'User has been deleted.',
        //             'success'
        //           )
                  

            

        //       }).catch(()=>{

        //           swal.fire("Failed","Something went wrong","warning");
        //       });
              
                
        //       })
            

        // },
        },
        mounted() {
           this.loadPortfolios();
        }
    }
</script>
