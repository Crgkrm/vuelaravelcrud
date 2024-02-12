
<template>
    <main>
    <div class="container"> 
   <div class="card">
   <div class="card-header">
  <h4>
    Students
    <RouterLink to="/students/create" class="btn btn-primary float-end">
    AddStudents
    </RouterLink>
  </h4>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
     <thead>
        <th>
          id  
        </th>
        <th>
          name
        </th>
        <th>
        course
        </th>
        <th>
          email
        </th>
        <th>
          phone
        </th>
        <th>
          Action
        </th>
     </thead>
     <tbody  v-if="this.students.length > 0">
        <tr v-for="(student , index) in this.students" :key="index">
         <td>{{ student.id }}</td>
         <td>{{ student.name }}</td>
         <td>{{student.course  }}</td>
         <td>{{ student.email }}</td>
         <td>{{ student.phone }}</td>
         <td>
          <router-link :to="{path:'/students/'+ student.id +'/edit'}" class="btn btn-success">Edit</router-link>
          <button class="btn btn-danger" @click="deleteStudent(student.id)">Delete</button>
         </td>
        </tr>
     </tbody>
     <tbody  v-else>
      <tr>
        <td colspan="6">Loading</td>
      </tr>
      </tbody>
    </table>
  </div>
  </div>
  </div>  
    </main>
  </template>
 <script>
 import axios from 'axios'
 export default{
  name:'students',
  data() {
    return{
        students:[]
    }
    
  },
  mounted(){
    this.getStudents();
  // console.log("hi");
  },
  methods:{
    deleteStudent(id){
      axios
      .delete(`http://localhost:8000/api/students/${id}`).then(response => {
       alert("student deleted successfully");
      });
    },
    getStudents(){
        axios
      .get('http://localhost:8000/api/students').then(response => {
       this.students=response.data.students;
       console.log(this.students);
      });
  }
    }
    
  }
  </script>
  