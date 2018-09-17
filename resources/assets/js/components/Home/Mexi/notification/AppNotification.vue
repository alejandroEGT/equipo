<template>
	
	<el-row>
		<el-dropdown trigger="click">
		  <el-button icon="el-icon-bell" circle>{{ unreadCount }}</el-button>
		  <el-dropdown-menu slot="dropdown">
		    <el-dropdown-item v-for="item in unread" :key="item.id">
		    <span @click="readIt(item)">{{ item.updatedBy}} creo la tarea: "{{ item.taskName }}" en Projecto "{{ item.project }}"</span>
			</el-dropdown-item>

		    <el-dropdown-item  v-if="unreadCount == 0">
		    	<span>No Tiene Notificaciones</span>
		    </el-dropdown-item>
		    
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
				readIt(notification){
					axios.post('/api/markAsRead',{id:notification.id})
					.then(res => {
						this.unread.splice(notification,1)
						this.read.push(notification)
						this.unreadCount --
					})
				},
				
			},
		}
</script>

<style>
	
</style>
