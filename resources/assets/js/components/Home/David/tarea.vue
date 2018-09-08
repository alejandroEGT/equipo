<template>
	<div>
		<el-form :inline="true" class="demo-form-inline">

				<el-input placeholder="Nombre Tarea" v-model="form.nombre" style="width: 20%;"></el-input>

        <el-date-picker v-model="form.calendario" type="daterange" align="right" start-placeholder="Fecha Inicio"end-placeholder="Fecha Fin"default-value="2018-9-01"></el-date-picker>

        <el-input placeholder="Horas estimadas" v-model="form.horas" style="width: 20%;"></el-input>

        <el-form-item>
          <el-select v-model="form.estadoProyecto" placeholder="Seleccione">
            <el-option label="En Desarrollo" value="enDesarrollo"></el-option>
            <el-option label="Terminada" value="Terminada"></el-option>
            <el-option label="No Iniciada" value="noIniciada"></el-option>
          </el-select>
        </el-form-item>

        <el-button @click=guardarTarea type="primary" icon="el-icon-edit" circle></el-button>

		</el-form>
	</div>
</template>

<script>
	export default{
					data(){
						return{
							espera:true,
							ver:false,
							arreglo:{},
							form:{}
						}
					},

					created(){
						
						this.api()
					},

					methods:{

           guardarTarea(){
              console.log(this.form)
            },

						get(){
						alert(this.titulo3)
						},
						api(){
							axios.get("api/david").then((rest)=>{
								this.arreglo = rest.data;
								this.espera = false;
							});
						}
					}
				}
</script>
