<template>
	<div>
		<center v-loading="titleLoad"><h3>Proyecto//{{ proyecto.nombre }}</h3>
			({{proyecto.cliente}}), Estado:
			<div class="btn-group">
				  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    {{ proyecto.estado }}
				  </button>
				  <div class="dropdown-menu">
				    <button v-for="e in estado" class="dropdown-item btn btn-link"
				     @click="cambiar_estado_proyecto(e.id)">{{ e.estado }}</button>
				    
				  </div>
				</div>
		</center>
		<hr>
		<div class="row">
			<div class="col-md-2">
				
				<el-badge :value="count_col" class="item">
				  	<el-button icon="fa fa-users" size="small" data-toggle="modal" data-target="#exampleModal"> 
				  		Colaboradores
					</el-button>
				</el-badge>

				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Colaboladores</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        	
						<div class="row">
							<div class="col-md-5">
								<el-select v-model="colaborador" filterable placeholder="Agrega colaborado">
								    <el-option
								      v-for="item in fil_colabo"
								      :key="item.id"
								      :label="item.nombres+' '+item.apellidos+' ('+ item.email +')'"
								      :value="item.id">
								    </el-option>
								</el-select>
							</div>
							<div class="col-md-2">
								<el-button type="success" @click="agregar_colaborador" icon="el-icon-check" circle></el-button>
							</div>
						</div>
						<hr>
						<table class="table table-responsive">
							<tr class="" >
								<td><strong>Colaborador</strong></td>
								<td><strong>Email</strong></td>
							</tr>
							<tr v-for="c in mis_colabo">
								<td>{{ c.nombres+" "+c.apellidos }}</td>
								<td>{{ c.email }}</td>
								<td>
									<el-button size="mini" type="warning" icon="el-icon-star-off" circle></el-button>
  									<el-button @click="delete_colaborador(c.id)" size="mini" type="danger" icon="el-icon-delete" circle></el-button>
								</td>
							</tr>
						</table>


				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-primary">Save changes</button>
				      </div>
				    </div>
				  </div>
				</div>
			</div>
			<div class="col-md-2">
				<el-button size="small" icon="far fa-calendar-alt" @click="click_cal"></el-button>
			</div>
		</div>
		<hr>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
			  <a class="navbar-brand" href="#">Navbar</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			    <div class="navbar-nav">
			     
			      <router-link :to="{path:'/proyecto/'+id_proyecto+'/tareas'}" class="btn btn-default btn-lg active">		Tareas
			      </router-link>
			      <!--<router-link :to="{path:'/proyecto/'+id_proyecto+'/flujo'}" class="btn btn-link">Flujo</router-link>-->
			     
			    </div>
			  </div>
			</nav>
		<br>
	{{ $route.path }}
		<transition name="fade" mode="out-in">
     		 <router-view :key="$route.path"></router-view>
    	</transition>
	</div>
</template>

<script>
    
	//import Autocomplete from 'vue2-autocomplete-js';
	export default{
		
		data(){
			return{
				id_proyecto: this.$route.params.id,
				proyecto:{},
				titleLoad:true,
				estado:{},
				count_col:'',
	            colaborador:'',
	            fil_colabo:{},
	            mis_colabo:{},
	           	
			}
		},
		created(){
			//kendo.culture("es-CL");
			this.traer_proyecto();
			this.traer_todos_colaboradores();
			this.listar_mis_colaboradores();
			console.log(this.activeIndex);
			
		},
		methods:{
			
			traer_proyecto(){
				axios.get('api/proyecto/'+this.id_proyecto).then((res)=>{
					this.proyecto = res.data.p;
					this.estado = res.data.estados;
					console.log(this.proyecto)
					this.titleLoad = false;
				});
				this.contar_colabo();
				
			},
			contar_colabo(){
				axios.get('api/contar_colaborador/'+this.id_proyecto).then((res)=>{
					this.count_col = res.data;
				});
			},
			traer_todos_colaboradores(){
				axios.get('api/todos_colaboradores/'+this.id_proyecto).then((res)=>{
					this.fil_colabo = res.data
				});
			},
			listar_mis_colaboradores(){
				axios.get('api/mis_colaboradores/'+this.id_proyecto).then((res)=>{
					this.mis_colabo = res.data
				});	
			},
			agregar_colaborador(){
			
				axios.post('api/agregar_colaborador',{ 
					colaborador: this.colaborador,
					id_proyecto: this.id_proyecto
				}).then((res)=>{
					this.traer_todos_colaboradores();
					this.listar_mis_colaboradores();
					this.colaborador = null;
					this.contar_colabo();
				});	
			},
			click_cal(){
				this.$router.push({ path:'/proyecto/calendario_tarea/'+this.id_proyecto });	
			},
			cambiar_estado_proyecto($id_estado){
				const datos={
					id_estado: $id_estado,
					id_proyecto: this.id_proyecto
				};
				axios.post('api/cambiar_estado_proyecto', datos).then((res)=>{
						if (res.data == "success") {
							this.traer_proyecto();
						}
				});
			},
			delete_colaborador($colaborador){
				axios.post('api/quitar_colaborador',{ 
					colaborador: $colaborador,
					id_proyecto: this.id_proyecto
				}).then((res)=>{
					this.traer_todos_colaboradores();
					this.listar_mis_colaboradores();
					this.colaborador = null;
					this.contar_colabo();
				});	
			}
			
		},
		mounted(){
			//this.links = this.loadAll();
		}
	}
</script>