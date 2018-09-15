<template>
	
	<el-row>
		<el-dropdown trigger="click">
		  <el-button icon="el-icon-bell" circle>1</el-button>
		  <el-dropdown-menu slot="dropdown">
		    <el-dropdown-item v-for="item in unread" :key="item.id">
		    {{ item.data.updatedBy}} creo la tarea: "{{ item.data.taskName }}" en Projecto "{{ item.data.project }}"
			</el-dropdown-item>
		    <el-dropdown-item  v-for="item in read" :key="item.id">{{ item.data.taskName }}</el-dropdown-item>
		  </el-dropdown-menu>
		</el-dropdown>
	</el-row>

</template>

<script>
	export default{
		data(){
			return{
				read:{},
				unread:{},
				unreadCount : 0,
			}
		},
		created(){
			this.getNotifications()
		},
		methods:{
			getNotifications(){
				axios.post('/api/notifications')
				.then(res => {
					this.read = res.data.read
					this.unread = res.data.unread
					this.unreadCount = res.data.unread.length
				})
			},
		},
	}
</script>

<style>
	
</style>
