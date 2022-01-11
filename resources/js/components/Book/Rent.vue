<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Rentar Libro</div>

                    <div class="card-body">
                        <template v-for="(item,index) in books">
                            <div class="row" v-bind:key="index">
                                
                                    <div class="col-xs-10 col-sm-9" >
                                        <div class="form-check form-switch">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">
                                                <span class="fw-bold">Nombre: </span>{{item.name}}
                                            </label>
                                            <p>
                                                <span class="fw-bold">Descripción:</span>
                                                <br>
                                                {{item.description}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-3" >
                                        <button v-if="item.rent==0" v-on:click="rentBook(item.id)" class="btn btn-success">Rentar</button>

                                        <button v-if="item.rent==1" v-on:click="unrentBook(item.id)" class="btn btn-info">Regresar</button>
                                    </div>
                                
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                books:[],
            }
        },
        created() {
            this.getBook();              
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            getBook(){
                axios.get('/books', {})
                .then(response=>{
                    console.log(response)
                    this.books = response.data.data;
                })
                .catch(error => {
                    console.log(error)
                });
            },
            rentBook(id){
                if (window.confirm("Esta seguro que desea rentar el libro?")) {
                    axios.put('/books/rent/'+id)
                    .then(response=>{
                        console.log(response)
                        this.books = response.data.data;
                        this.getBook();
                    })
                    .catch(error => {
                        console.log(error)
                    });
                }
            },
            unrentBook(id){
                if (window.confirm("Esta seguro que desea regresar el libro?")) {
                    axios.put('/books/unrent/'+id)
                    .then(response=>{
                        console.log(response)
                        this.books = response.data.data;
                        this.getBook();
                    })
                    .catch(error => {
                        console.log(error)
                    });
                }
            }
        }
    }
</script>