<template>
    <main class="minimo">
        <template v-if="listado==0">
        <!-- Ejemplo de tabla Listado -->
        <div>
                            <div class="table-responsive">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Unidad Base</th>
                                        <th>Cantidad Sistema</th>
                                        <th>Cantidad Actual</th>
                                        <th>Diferencia</th>
                                        <th>Observación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <!-- V-for inicial sin trabajar matriz
                                    <tr v-for="total in arrayProductos" :key="total.id">
                                        <td>{{total.producto}}</td>
                                        <td>{{total.unidadBase}}</td>
                                        <td><input type="number" v-model="cantidad" class="form-control" placeholder="Cantidad"></td>
                                        <span v-show="flag"><input type="hidden" v-model="idGestionMateria">{{total.id}}</input></span>
                                    </tr>
                                -->
                                <tr v-for="total in arrayProductos" :key="total.id">
                                        <td>{{total.producto}}</td>
                                        <td>{{total.unidadBase}}</td>
                                        <td>{{total.cantidadSistema}}</td>
                                        <td>{{total.cantidadActual}}</td>
                                        <td>{{total.diferencia}}</td>
                                        <td><input type="text" v-model="observacion[total.id]" class="form-control" placeholder="Observacion"></td>
                                         <!--<input type="hidden" value="@{{ total.idInventario}}" v-model="idInventario" />
                                         <td>
                                             <input type="hidden" name="idInventario[]" value="{{total.idInventario}}">
                                         </td>-->
                                </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-warning" @click="finalizar(observacion)">Finalizar Inventario</button>
                            </form>
                            </div>
                            <nav>
                <ul class="pagination">
                    <li class="page-item" v-if="pagination.current_page > 1">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                    </li>
                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                    </li>
                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                    </li>
                </ul>
            </nav>
                    <!-- Fin ejemplo de tabla Listado -->
        </div>
        </template>
    </main>
</template>

<script>
    export default {
        props: {
            identificador: {
            type: Number
            }
         },
        data(){
            return{
                listado : 0,
                arrayProductos:[],
                modal : 0,
                tipoModal : 0,
                tipoAccion : 0,
                cantidad: [],
                observacion:[],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'id',
                buscar : ''
            }
        },
         computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginacion
            pagesNumber: function(){
                if (!this.pagination.to) {
                    return[];
                }

                var from=this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods : {
        listarObservacion(page,identificador){
                let me=this;
                var url='/inventariodetalle/listar2?page=' + page + '&id='+identificador;
                console.log(url);
                axios.get(url).then(function (response) {
                var respuesta=response.data;
                me.arrayProductos=respuesta.productos.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
        finalizar(observacion){
                //valido con el metodo de validacion creado
                let me=this;
                console.log('idGestionMateria antes de solicitud en el ultimo paso');
                observacion[0]=this.identificador;
                console.log(observacion,this.identificador);
                console.log('Fin Cargue antes de solicitud en el ultimo paso');
                axios.post('/inventariodetalle/observacion',{
                    data: observacion,
                     'id': this.identificador
                }).then(function (response) {
                var respuesta=response.data;
                console.log('Respuesta en el ultimo paso');
                console.log(respuesta);
                console.log('Fin Respuesta en el ultimo paso');
                me.$emit('finalizarlistado', { message: '3' });
                me.cerrarModal('0');
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
        cambiarPagina(page){
                let me = this;
                //Actualiza la pagina actual
                me.pagination.current_page = page;
                //envia peticion para ver los valores asociados a esa pagina
                me.listarObservacion(page,this.identificador);
            }
        },
        mounted() {
            this.listarObservacion(1,this.identificador)
        }
    }
</script>

<style>
    .minimo {
	min-height: 150px;
    }
</style>
