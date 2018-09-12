<template>
	<div>
		<h3>{{ titulo }}</h3>
		<h1>{{ titulo2 }}</h1>
		<el-button 
			@click="ver = true "
		>click</el-button>
		<hr>
		<table v-if="ver" v-loading="espera"  class="table table-borded" >
			<tr>
				<td><strong>Nombre</strong></td>
				<td><strong>Apellido</strong></td>
			</tr>
			<tr v-for="a in arreglo" >
				<td>{{ a.nombre }}</td>
				<td>{{ a.apellido }}</td>
			</tr>
		</table>
	</div>

</template>

<script>
	export default{
					data(){
						return{
							espera:true,
							ver:false,
							titulo:'Hola soy David Luna trolo',
							titulo2:'chao ya no soy david',
							titulo3:'kkck',
							arreglo:{}

						}
					},

					created(){
						
						this.api()
					},

					methods:{
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
