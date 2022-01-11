<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <label for="exampleFormControlInput4" class="form-label">Categoria</label>
                <select v-model="search.category" class="form-select" aria-label="Categoria">
                    <template v-for="(index,item) in listCategory">
                        <option v-bind:key="index" :value="index">{{ index }}</option>
                    </template>
                </select>
            </div>

            <div class="col-sm-4">
                <label for="exampleFormControlInput4" class="form-label">Fecha de Lazamiento</label>
                <select v-model="search.released_at" class="form-select" aria-label="Categoria">
                    <option value="asc">Ascendente</option>
                    <option value="desc">Descendente</option>
                </select>
            </div>

            <div class="col-sm-4"  >
                <button class="btn btn-primary" style="float:right" @click="getBook" type="button">Buscar</button>
            </div>

            <div class="col-md-12">
                <br>
            </div>
            <div class="col-md-12">

                
                <div class="card">
                    <div class="card-header">Filtro de Busqueda</div>

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
                                        <router-link :to="'/book/edit/'+item.id" class="btn btn-warning"><span class="material-icons" style="vertical-align:top;">edit</span></router-link>

                                        <button v-on:click="deleteBook(item.id)" class="btn btn-danger"><span class="material-icons" style="vertical-align:top;">delete</span></button>
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
                search:{
                    category: 'Drama',
                    released_at: 'desc',
                },
                listCategory:[
                    'Drama',
                    'Historia'
                ],
            }
        },
        created() {
            //this.getBook();              
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            getBook(){
                axios.post('/books/search',this.search)
                .then(response=>{
                    console.log(response)
                    this.books = response.data.data;
                })
                .catch(error => {
                    console.log(error)
                });
            },
            deleteBook(id){
                if (window.confirm("Esta seguro que desea eliminar el registro?")) {
                    axios.delete('/books/'+id)
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