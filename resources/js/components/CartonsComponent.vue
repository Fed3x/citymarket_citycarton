<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row informations">
                    <div class="col-md-3 infos">
                        <span class="info-icon text-primary">
                            <i class="fas fa-store fa-2x"></i>
                        </span> 
                        <span class="info-site">
                            <span class="info-tittle">Sucursal</span>
                            <span class="info-info"><b>{{site || 'Sucursal no Identificada'}}</b></span>
                        </span> 
                    </div>
                    <div class="col-md-3 infos">
                        <span class="info-icon text-warning">
                            <i class="fas fa-cash-register fa-2x"></i>
                        </span> 
                        <span class="info-checkout" >
                            <span class="info-tittle">Caja</span>
                            <span class="info-info"><b>N° {{ pos || 'Caja no Identificada'}}</b></span>
                        </span>
                    </div>
                    <div class="col-md-3 infos">
                        <span class="info-icon text-success">
                            <i class="fas fa-newspaper fa-2x"></i>
                            </span>
                        <span class="info-carton">
                            <span class="info-tittle">Cartones</span>
                            <span class="info-info"><b>{{cartons.length}}</b></span>
                        </span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Cartones</div>

                    <div class="card-body card-body-carton">
                        <div>
                            <div class="alert collapse text-center" role="alert" id="AlertMessage" :class="alert.class">
                                {{alert.message}}
                            </div>
                            <input-carton-component
                            @add="AddCarton($event)"
                            @error="ErrorCarton($event)"
                            ></input-carton-component>
                        </div>
                        <hr>
                        <div class="cartons">
                            <carton-component v-for="(carton, index) in cartons" 
                            :key="carton.id"
                            :carton="carton"
                            :index="index"
                            @delete="DeleteCarton($event)"
                            @save="SaveCarton($event)"
                            @error="ErrorCarton($event)"
                            ></carton-component>
                        </div>
                        
                        
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
    import EventBus from "../components/event-bus"
    export default {
        data(){
            return{
                alert:{
                    class: '',
                    message: '',
                },
                site: '',
                pos: '',
                cartons: [],

            }

        },
        mounted() {
            axios.get('/user')
                .then((response)=>{
                    this.site = response.data.site[0];
                    this.pos = response.data.pos[0];
            });

            axios.get('/carton')
                .then((response)=>{
                    this.cartons = response.data;
            });
        },
        created(){

        },
        methods:{
            Alert(){
                if ($('#AlertMessage').is(':visible')) {
                    $('#AlertMessage').delay(4000);
                }
                 $('#AlertMessage').fadeIn();     
                setTimeout(function() {
                    $("#AlertMessage").fadeOut();           
                },4000);
            },
            ErrorCarton(message){
                this.alert.class = 'alert-danger';
                this.alert.message = message;
                this.Alert();
            },
            AddCarton(draft){
                this.cartons.push(draft);
                this.alert.class = 'alert-success';
                this.alert.message = 'El codigo de cartón ' + draft.barcode + ' ingresado correctamente.';
                this.Alert()
            },
            DeleteCarton(index){
                this.cartons.splice(index,1);
            },
            SaveCarton(draft){
                this.cartons.splice(draft.index,1, draft.carton);
                this.alert.class = 'alert-success';
                this.alert.message = 'El codigo de cartón ' + draft.carton.barcode + ' ingresado correctamente.';
                this.Alert()
            },
            ClearCartons(){
                this.cartons.splice(0);
            }

        }
    }
</script>
<style scoped>
.informations{
    margin: 0 0 20px 0;
    justify-content: space-around;
 }
.info-info{
    font-size: 18px;
    width: 100%;
    text-align: center;
}
.info-icon{
    display: flex;
    align-items: center;
    height: 100%;
    width: 30%;
    justify-content: center;
    font-size: 2rem;
}

.infos{
    border-radius: calc(0.25rem - 1px);
    display: flex;
    background-color: white;
    box-shadow: 2px 5px 10px rgba(0, 0, 0,0.075);
    padding: 10px;
}

.info-site{
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-top: 3%;
    width: 100%;
}
.info-tittle{
    display: block;
    text-align: center;
    width: 100%;
}

.info-checkout{
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-top: 3%;
    width: 100%;
}

.info-carton{
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-top: 3%;
    width: 100%; 
}

.add-carton{
    margin-top: 4px;
    margin-left: 5px;
}
.button-group{

    display: flex;
    flex-direction: row;
    margin-top: 20px;
    justify-content: space-around;
}
.cartons{
    max-height: 40vh;
    overflow-y: scroll;
    width: 100%;
}

</style>