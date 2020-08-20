<template>
    <div>
        <div class="form-row col-md-12">
            <div class="col-md-12">
                <label for="input-header-carton">Cartón</label>
                <input type="text" class="form-control input-header-carton" id="input-header-carton" placeholder="Escanee el codigo del Carton" v-model="draft" v-on:keydown.enter="New()" v-if="CartonLenght==0" > 
                <input type="text" class="form-control input-header-carton" :class="{ 'is-invalid': CartonInvalid, 'is-valid' : CartonValid}" id="input-header-carton" placeholder="Escanee el codigo del Carton" v-model="draft" v-on:keydown.enter="New()" v-else > 
                
                <div  v-show="CartonLenght>0">
                    <small class="form-text text-muted"> Se ingresó <b>{{CartonLenght}}</b> dígitos</small>
                </div>
                <div class="empty-box"  v-show="CartonLenght==0">
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>


.empty-box{
    width: 100%;
    height: 23.0333px;
}

</style>

<script>
    import EventBus from "../components/event-bus"
    export default {
        data(){
            return{
                edit: false,
                draft: '',
                carton_type: 1,
            }

        },
        computed:{
            CartonLenght: function(){
                return this.draft.length;
            },
            CartonValid: function(){
                let regex = /^[0-9]{6,8}$/g;
                let result = regex.test(this.draft);
                if(result){
                    return true;
        
                }else{
                    return false;
                }
            },
            CartonInvalid: function(){
                let regex = /^[0-9]{6,8}$/g;
                let result = regex.test(this.draft);
                if(!result){
                    return true;
        
                }else{
                    return false
                }
            }
        },
        methods:{
            New(){
                let regex = /^[0-9]{6,8}$/g;
                let result = regex.test(this.draft);
                
                if(result){
                    let parametros = {
                        barcode: this.draft,
                        carton_type_id: this.carton_type
                    }
                    axios.post('/carton', parametros)
                        .then((response)=>{
                            this.$emit('add', response.data);
                            this.draft = '';
                        })
                        .catch((error)=>{
                            this.$emit('error', error.response.data.barcode[0]);
                        });
                }else{
                    
                }
            
            }   

        }
    }
</script>