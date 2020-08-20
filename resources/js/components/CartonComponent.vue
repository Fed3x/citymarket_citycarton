<template>
    <div>
        <div class="form-row col-md-12" v-if="edit">
      
                <div class="col-md-2">
                     <input type="text" class="form-control type-carton" :value="carton.carton_type.description" disabled> 
                </div>
                <div class="col-md-9 input-edit-carton">
                    <input ref="carton" type="text" class="form-control"  placeholder="Escanee el codigo del Carton" v-model="draft" v-on:keydown.enter="Save()" v-if="CartonLenght==0" >
                    <input ref="carton" type="text" class="form-control" :class="{ 'is-invalid': CartonInvalid, 'is-valid' : CartonValid}"  placeholder="Escanee el codigo del Carton" v-model="draft" v-on:keydown.enter="Save()" v-else > 
                    <div  v-show="CartonLenght>0">
                        <small class="form-text text-muted"> Se ingresó <b>{{CartonLenght}}</b> dígitos</small>
                    </div>
                    <div class="empty-box"  v-show="CartonLenght==0"></div>
                </div>
                <div class="col-md-1">
                    <span v-on:click="Save()" data-toggle="tooltip" data-placement="auto" title="Guardar registro" ><i class="fas fa-save fa-2x text-primary icon-carton icon-carton--width-32 button-icon"></i></span> <span v-on:click="Discard()" data-toggle="tooltip" data-placement="auto" title="Descartar cambios" ><i class="fas fa-times fa-2x text-secondary icon-carton icon-carton--width-25 button-icon"> </i>  </span>
                </div>

        </div>
        <div class="form-row col-md-12" v-else>
            <div class="col-md-2">
                <input type="text" class="form-control type-carton" :value="carton.carton_type.description" disabled> 
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control input-edit-carton" :value="carton.barcode" disabled> 
            </div>
            <div class="col-md-1">
                <span v-on:click="Edit()" data-toggle="tooltip" data-placement="auto" title="Editar registro" ><i class="fas fa-edit fa-2x text-warning icon-carton icon-carton--width-32 button-icon"></i></span> <span v-on:click="Delete()" data-toggle="tooltip" data-placement="auto" title="Eliminar registro" ><i class="fas fa-trash-alt fa-2x text-danger icon-carton icon-carton--width-25 button-icon"></i>  </span>
            
                
            </div>
            
        </div>
    </div>
</template>
<script>
    import EventBus from "../components/event-bus"
    export default {
        props: ['carton', 'index'],
        data(){
            return{
                edit: false,
                draft: ''
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
        created(){
            EventBus.$on('editing', function(index){
                if (this.index != index){
                    this.edit = false;
                }
            }.bind(this));
        },
        methods:{
            Edit(){
                EventBus.$emit('editing', this.index);
                this.draft = this.carton.barcode;
                this.edit = true;
            },
            Discard(){
                this.edit = false;
            },
            Delete(){
                axios.delete('/carton/'+this.carton.id)
                    .then(()=>{
                        this.$emit('delete', this.index);
                });
                
            },
            Save(){
                let regex = /^[0-9]{6,8}$/g;
                let result = regex.test(this.draft);
                if(result){
                    let parametros = {
                        barcode: this.draft,
                    }
                    axios.put('/carton/'+this.carton.id, parametros)
                        .then((response)=>{
                            this.$emit('save', {'index': this.index, 'carton': response.data});
                            this.edit = false;
                        })
                        .catch((error)=>{
                           
                            this.$emit('error', error.response.data.message);
                            console.log(error.data);
                            console.log(error.message);
                        });
                }else{
                    
                }
            },
        }
    }
</script>
<style scoped>
.empty-box{
    width: 100%;
    height: 23.0333px;
}
.type-carton{
    margin-bottom: 20px;
}

.input-edit-carton{
    display: inline-block;
    width: 100%;
    margin-bottom: 20px;
}

.icon-carton{
    padding-top: 4px;
    margin-left: 5px;
}
.icon-carton--width-32{
    width: 32px
}

.icon-carton--width-25{
    width: 25px
}
.button-icon{
    cursor: pointer;
}


</style>