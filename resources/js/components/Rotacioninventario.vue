<template>
        <main class="main">
                <!-- Breadcrumb -->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Rotación de inventario</li>
                </ol>

                <template v-if="listado==1">
                <div class="container-fluid">
                    <!-- Ejemplo de tabla Listado -->

                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Rotación de inventario &nbsp;
                            <button type="button" @click="mostrarDetalle()" class="btn btn-secondary">
                                <i class="icon-plus"></i>&nbsp;Nuevo
                            </button>
                        </div>
                        <div class="card-body">
                            <!--
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="form-control col-md-3" v-model="criterio">
                                        <option value="id">Id</option>
                                        <option value="area">Area</option>
                                        </select>
                                        <input type="text" v-model="buscar" @keyup.enter="listarArea(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                        <button type="submit" @click="listarArea(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </div>
                            -->
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Detalle</th>
                                        <th>Fecha inicial</th>
                                        <th>Fecha final</th>
                                        <th>Saldo periodo actual</th>
                                        <th>Saldo periodo anterior</th>
                                        <th>Costo de ventas</th>
                                        <th>Suma saldos</th>
                                        <th>Promedio saldos</th>
                                        <th>Rotación inventario</th>
                                        <th>Periodo</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="precio in arrayPrecios" :key="precio.id">
                                        <td v-text="precio.detalle"></td>
                                        <td v-text="precio.fechainicial"></td>
                                        <td v-text="precio.fechafinal"></td>
                                        <td v-text="precio.saldoperiodoactual"></td>
                                        <td v-text="precio.saldoperiodoanterior"></td>
                                        <td v-text="precio.costodeventas"></td>
                                        <td v-text="precio.sumasaldos"></td>
                                        <td v-text="precio.promediosaldos"></td>
                                        <td v-text="precio.rotacioninventario"></td>
                                        <td v-if="precio.tipoperiodo==1">Mensual</td>
                                        <td v-if="precio.tipoperiodo==2">Diario</td>
                                    </tr>
                                </tbody>
                            </table>
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
                        </div>
                    </div>
                </div>
                </template>

                <template v-if="listado==2">

                <div class="container-fluid">
                    <!-- Ejemplo de tabla Listado -->
                <vs-tabs :color="colorx">

                    <vs-tab label="Rotación inventario" icon="open_with" @click="colorx = '#FFA500'">
                    <div class="card">
                        <div class="card-body">

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Fecha Inicial</label>
                                        <div class="col-md-9">
                                            <input type="date" v-model="fechainicial" class="form-control">
                                            <span class="help-block">(*) Ingrese el valor de la fecha inicial</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Fecha Final</label>
                                        <div class="col-md-9">
                                            <input type="date" v-model="fechafinal" class="form-control">
                                            <span class="help-block">(*) Ingrese el valor de la fecha final</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Tipo de periodo a calcular</label>
                                        <div class="col-md-9">
                                                <select class="form-control" v-model="tipoperiodo">
                                                <option value="0" disabled>Elija su opción</option>
                                                <option value="1">Meses</option>
                                                <option value="2">Dias</option>
                                                </select>
                                                <span class="help-block">(*) Ingrese el tipo de periodo a calcular</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Saldo periodo actual</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="saldoperiodoactual" class="form-control" placeholder="Saldo periodo actual">
                                            <span class="help-block">(*) Ingrese el valor del saldo periodo actual</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Saldo periodo anterior</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="saldoperiodoanterior" class="form-control" placeholder="Saldo periodo anterior">
                                            <span class="help-block">(*) Ingrese el valor del saldo periodo anterior</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Costo de ventas</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="costodeventas" class="form-control" placeholder="Costo de ventas">
                                            <span class="help-block">(*) Ingrese el valor del costo de ventas</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="puntoequilibriopesos">Suma saldos: {{ parseInt(parseInt(saldoperiodoactual)+parseInt(saldoperiodoanterior)) }}</label>
                                    </div>
                                    <div class="form-group row">
                                        <label for="puntoequilibriopesos">Promedio saldos: {{ parseInt(parseInt(parseInt(saldoperiodoactual)+parseInt(saldoperiodoanterior))/2) }}</label>
                                    </div>
                                    <div class="form-group row">
                                        <label for="puntoequilibriopesos">Rotación de inventario en veces: {{ parseFloat(costodeventas/(parseInt(parseInt(saldoperiodoactual)+parseInt(saldoperiodoanterior))/2)).toFixed(2) }}</label>
                                    </div>
                                    <div class="form-group row" v-if="tipoperiodo==1">
                                        <label for="puntoequilibriopesos">Rotación de inventario en meses: {{ parseFloat(12/(costodeventas/(parseInt(parseInt(saldoperiodoactual)+parseInt(saldoperiodoanterior))/2))).toFixed(2) }}</label>
                                    </div>
                                    <div class="form-group row" v-if="tipoperiodo==2">
                                        <label for="puntoequilibriopesos">Rotación de inventario en dias: {{ parseFloat(360/(costodeventas/(parseInt(parseInt(saldoperiodoactual)+parseInt(saldoperiodoanterior))/2))).toFixed(2) }}</label>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-primary" @click="crearPuntoEquilibrio(),ocultarDetalle()">Guardar</button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        </vs-tab>

                    <vs-tab label="Cerrar" icon="cancel_schedule_send" @click="ocultarDetalle()">
                    </vs-tab>

                </vs-tabs>
                    <!-- Fin ejemplo de tabla Listado -->
                </div>

                </template>
        </main>
</template>

<script>
    import moment from 'moment';
    export default {
        data(){
            return{
                colorx: '#8B0000',
                listado: 1,
                idProducto:0,
                flag: 0,
                saldoperiodoactual:0,
                saldoperiodoanterior:0,
                fechainicial:'',
                fechafinal:'',
                costodeventas:0,
                ingresostotales:0,
                tipoperiodo:0,
                arrayPosibles : [],
                errorVinculacion : 0,
                errorMensaje : [],
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
                if (this.pagination.to) {
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
            crearPuntoEquilibrio(){
                //valido con el metodo de validacion creado
                /*
                if(this.validarManoDeObraProducto()){
                    return;
                }
                */

                axios.post('/simulaciones/storeRotacioninventario',{
                    'fechainicial': this.fechainicial,
                    'fechafinal': this.fechafinal,
                    'saldoperiodoactual': this.saldoperiodoactual,
                    'saldoperiodoanterior': this.saldoperiodoanterior,
                    'costodeventas': this.costodeventas,
                    'ingresostotales': this.ingresostotales,
                    'tipoperiodo': this.tipoperiodo

                }).then(function (response) {
                this.ocultarDetalle();
                this.forceRerender();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarRotacioninventario(page){
                let me=this;
                var url='/simulaciones/listarRotacioninventario?page=' + page;
                axios.get(url).then(function (response) {
                var respuesta=response.data;
                me.arrayPrecios=respuesta.rotacioninventario.data;
                me.pagination=respuesta.pagination;
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
                me.listarRotacioninventario(page);
            },
            indexChange: function(args) {
                let newIndex = args.value
                console.log('Current tab index: ' + newIndex)
                },
            forceRerender() {
                this.componentKey += 1;
               },
            mostrarDetalle(){
                this.listado=2;
                this.identificador=0;
            },
            ocultarDetalle(){
                this.listado=1;
                this.identificador=0;
                this.listarRotacioninventario(1);
            }
        },
        mounted() {
            this.listarRotacioninventario(1);
        }

    }
</script>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>
