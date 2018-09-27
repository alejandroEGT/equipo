<template>
  <div class="container">
    <div ref="gantt">
  </div>
  </div>
  
</template>

<script>
import 'dhtmlx-gantt'
export default {
  name: 'gantt',

  mounted: function () {
      this.getTasks()
      this.configGantt()
  },

  methods:{
        getTasks(){
          axios.get(`/api/gantt/${this.$route.params.id}`)
          .then(res => {
            gantt.init(this.$refs.gantt)
            gantt.calculateDuration(res.data);
            gantt.clearAll()
            gantt.parse(res.data)
          })
        },
        configGantt(){
            gantt.config.readonly = true
            gantt.config.xml_date = "%Y-%m-%d %H:%i:%s"
            gantt.config.columns =  [
                {name:"text",       label:"Tarea",  align:"center" },
                {name:"start_date", label:"Inicio", align:"center" },
                {name:"end_date",   label:"Fin",   align:"center" },
                {name:"duration",   label:"Duracion",   align:"center" },
                {name:"progress",   label:"Progreso",   align:"center" },
            ];
        }
      }
    }
  
</script>

<style>
  @import "~dhtmlx-gantt/codebase/dhtmlxgantt.css";
</style>