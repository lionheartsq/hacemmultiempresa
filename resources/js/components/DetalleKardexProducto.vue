<template>
    <main class="minimo">
        <template v-if="listado==0">
        <!-- Ejemplo de tabla Listado -->
        <div>

                    <div class="form-group row">
                        <div class="col-md-9">
                            <div class="input-group">
                                <div v-for="nombre in arrayNombres" :key="nombre.id">
                                  &nbsp;<b>Producto: </b> {{nombre.producto}}
                                </div>
                            </div>
                        </div>
                    </div>

                            <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Detalle</th>
                                        <th>Producto</th>

                                        <th>Entradas<br>Cantidad</th>
                                        <th>Entradas<br>Precio Unitario</th>
                                        <th>Entradas<br>Precio total</th>
                                        <th>Salidas<br>Cantidad</th>
                                        <th>Salidas<br>Precio Unitario</th>
                                        <th>Salidas<br>Precio total</th>

                                        <th>Saldos<br>Cantidad</th>
                                        <th>Saldos<br>Precio Unitario</th>
                                        <th>Saldos<br>Precio total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="total in arrayProductos" :key="total.idProducto">
                                        <td>{{total.fecha}}</td>
                                        <td>{{total.detalle}}</td>
                                        <td>{{total.producto}}</td>
                                            <td v-if="total.tipologia==1">{{total.cantidad}}</td>
                                            <td v-if="total.tipologia==1">{{total.precio}}</td>
                                            <td v-if="total.tipologia==1">{{total.preciototal}}</td>
                                            <td v-if="total.tipologia==1">0</td>
                                            <td v-if="total.tipologia==1">0</td>
                                            <td v-if="total.tipologia==1">0</td>

                                            <td v-if="total.tipologia==2">0</td>
                                            <td v-if="total.tipologia==2">0</td>
                                            <td v-if="total.tipologia==2">0</td>
                                            <td v-if="total.tipologia==2">{{total.cantidad}}</td>
                                            <td v-if="total.tipologia==2">{{total.precio}}</td>
                                            <td v-if="total.tipologia==2">{{total.preciototal}}</td>
                                        <td>{{total.cantidadSaldos}}</td>
                                        <td>{{total.precioSaldos}}</td>
                                        <td>{{total.totalsaldos}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                    <!-- Fin ejemplo de tabla Listado -->
            <nav>
                <ul class="pagination">
                    <li class="page-item" v-if="pagination.current_page > 1">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)">Ant</a>
                    </li>
                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
                    </li>
                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1)">Sig</a>
                    </li>
                </ul>
            </nav>

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
                arrayNombres:[],
                modal : 0,
                tipoModal : 0,
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3
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
            acumuladoTotal(identificador){
                let me=this;
                var url='/kardexproducto/listar/?identificador='+this.identificador;
                axios.get(url).then(function (response) {
                var respuesta=response.data;
                me.arrayProductos=respuesta.kardex.data;
                me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            productoNombre(identificador){
                let me=this;
                var url='/kardexproducto/producto?identificador='+this.identificador;
                axios.get(url).then(function (response) {
                var respuesta=response.data;
                me.arrayNombres=respuesta.nombreproducto;
                console.log(url);
                console.log(respuesta);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            cambiarPagina(page){
                let me = this;
                //Actualiza la pagina actual
                me.pagination.current_page = page;
                //envia peticion para ver los valores asociados a esa pagina
                me.acumuladoTotal(page,this.identificador);
            }
        },
        mounted() {
            this.acumuladoTotal(this.identificador);
            this.productoNombre(this.identificador)
        }
    }
</script>

<style>
    .minimo {
	min-height: 150px;
    }
</style>
