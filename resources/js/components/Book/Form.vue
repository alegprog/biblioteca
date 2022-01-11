<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">Agregar Libro</div>

                    <div class="card-body">
                        <div v-if="status" class="alert alert-success" role="alert">
                            Se ha agregado la tarea satifactoriamente
                        </div>
                        <div v-if="statusError" class="alert alert-danger" role="alert">
                            Ha ocurrido un error de validacion intente nuevamente
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                            <input type="text" v-model="info.name" class="form-control" id="exampleFormControlInput1" placeholder="Nombre del Libro">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput2" class="form-label">Descripción</label>
                            <input type="text" v-model="info.description" class="form-control" id="exampleFormControlInput2" placeholder="Descripción del Libro">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput3" class="form-label">Fecha de Lanzamiento</label>
                            <input type="date" v-model="info.released_at" class="form-control" id="exampleFormControlInput3">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput4" class="form-label">Categoria</label>
                            <select v-model="info.category" class="form-select" aria-label="Categoria">
                                <template v-for="(index,item) in listCategory">
                                    <option v-bind:key="index" :value="index">{{ index }}</option>
                                </template>
                            </select>
                        </div>

                        <div class="d-grid gap-2 col-4 mx-auto">
                            <button class="btn btn-primary" @click="saveBook" type="button">Guardar</button>
                        </div>
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
                info: {
                    name: null,
                    description: null,
                    released_at: null,
                    category: null
                },
                listCategory:[
                    'Drama',
                    'Historia'
                ],
                status: false,
                statusError: false,
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            saveBook(){
                this.status = false;
                this.statusError = false;
                let info = this.info;
                axios.post('/books', info)
                .then(response=>{
                    console.log(response)
                    this.status = true;
                    this.info.name = '';
                    this.info.description = '';
                    this.info.released_at = null;
                    this.info.category = null
                })
                .catch(error => {
                    console.log(error)
                    this.statusError = true;
                });
            }
        }
    }
</script>
