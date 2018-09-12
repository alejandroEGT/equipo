<template>
	<div>
		<el-form :inline="true" class="demo-form-inline">

				<el-input placeholder="Nombre Tarea" v-model="form.nombre" style="width: 20%;"></el-input>

        <el-date-picker v-model="form.calendario" type="daterange" align="right" start-placeholder="Fecha Inicio"end-placeholder="Fecha Fin"default-value="2018-9-01"></el-date-picker>

        <el-input placeholder="Horas estimadas" v-model="form.horas" style="width: 20%;"></el-input>

        <el-form-item>
          <el-select v-model="form.estadoProyecto" placeholder="Seleccione">
            <el-option v-for="t in estados" :label="t.estado" :value="t.id" :key="t.id"></el-option>
          </el-select>
        </el-form-item>

        <el-button @click="guardarTarea" type="primary" icon="el-icon-edit" circle></el-button>

		</el-form>

		<table class="table table-borded">
			<tr>
				<td>Nombre</td>
				<td>Fecha Inicio</td>
				<td>Fecha Fin</td>
				<td>Horas Estimadas</td>
			</tr>
			<tr v-for="t in tareas">
				<td>{{t.nombre}}</td>
				<td>{{t.fecha_inicio}}</td>
				<td>{{t.fecha_fin}}</td>
				<td>{{t.horas_estimadas}}</td>
			</tr>
		</table>

	</div>
</template>

<script>
	export default{
		data(){
			return{
				tareas:{},
				form:{idProyecto:this.$route.params.id,idUser:this.$auth.user().id,},
				estados:{},
				//idProyecto:this.$route.params.id,
				//idUser:this.$auth.user().id,
			}
		},

		created(){
			this.listarTarea()
			this.llenarSelect()
		},

		methods:{

   			guardarTarea(){
       	        axios.post("api/insertarTarea", this.form).then((rest)=>{
					this.listarTarea();
	            });

            },

			llenarSelect(){
				axios.get("api/llenarEstadosTarea").then((rest)=>{
					this.estados = rest.data;
				});
				
			},
			listarTarea(){
				axios.post("api/listarTarea", 
					{
						idProyecto:this.$route.params.id,
						idUser:this.$auth.user().id,
					}).then((rest)=>{
						this.tareas = rest.data;
				});
			},
		}
	}
</script>
