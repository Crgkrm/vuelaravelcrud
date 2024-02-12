<template>
    <div class="container mt-5">
     <div class="card">
        <div class="card-body">
            <h4>Editstudent</h4>
        </div>
        <div class="card-body">
          <ul v-if="Object.keys(this.errorList).length > 0 ">
              <li class="text-danger" v-for="(error , index) in this.errorList" :key="index">
             {{ error[0] }}
            </li>
            </ul>
            <div class="mb-3">
            <label for="name" >name</label>
            <input type="text" v-model="model.student.name"  class="form-control"/>
            </div>
            <div class="mb-3">
            <label for="course">course</label>
            <input type="text" v-model="model.student.course"  class="form-control"/>
            </div>            
            <div class="mb-3">
            <label for="email">email</label>
            <input type="text" v-model="model.student.email" class="form-control"/>
            </div>
             <div class="mb-3">
            <label for="phone">phone</label>
            <input type="text" v-model="model.student.phone" class="form-control"/>
            </div>
            <div class="mb-3">
            <button v-on:click="updateStudent(this.$route.params.id)" class="btn btn-primary">Save</button>
            </div>
        </div>
     </div>
    </div>
</template>
<script>
 import axios from 'axios';
 import {ref, onMounted } from 'vue';
 export default {
  data(){
    return{
        errorList:'', 
        model:{
        student:{
            name:'',
            course:'',
            email:'',
            phone:'',
        }, 
    }
    }
  },
    mounted(){
    this.getStudent(this.$route.params.id);
    console.log(this.$route.params.id);

  },
  methods:{
    getStudent(id){
        axios
      .get(`http://localhost:8000/api/students/${this.$route.params.id}/edit`).then(response => {
         this.model.student=response.data.student;
      });
  },
    updateStudent(id){
     var $mythis=this; 
        axios
      .put(`http://localhost:8000/api/students/${this.$route.params.id}/edit`,this.model.student).then(response => {
        //empty the input
      alert("student updated successfully");
       this.errorList='';
      })
      .catch(function (error){
       if(error.response){
        $mythis.errorList=error.response.data.errors;
       }
      });
  

   }

    }

    
 }
 

</script>