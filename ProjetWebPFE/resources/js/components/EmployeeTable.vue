<template>
  <div>
    <table class="table caption-top">
      <caption class="text-body-secondary">Liste d'employé :</caption>
      <thead>
        <tr class="table-primary">
          <th scope="col">mail</th>
          <th scope="col">Nom</th>
          <th scope="col">Prénom</th>
          <th scope="col">Sexe</th>
          <th scope="col">Lieu de Naissance</th>
          <th scope="col">Date de Naissance</th>
          <th scope="col">Adresse</th>
          <th scope="col">Num</th>
          <th scope="col">Departement</th>
          <th scope="col">Poste</th>
          <th colspan="4"> </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="employe in employes" :key="employe.idEmploye">
          <td>{{ employe.mail }}</td>
          <td>{{ employe.nom }}</td>
          <td>{{ employe.prenom }}</td>
          <td>{{ employe.sexe }}</td>
          <td>{{ employe.LieuNaiss }}</td>
          <td>{{ employe.DateNaiss }}</td>
          <td>{{ employe.Num }}</td>
          <td>{{ employe.Adresse }}</td>
          <td>{{ employe.departement ? employe.departement.nom : 'N/A' }}</td>
          <td>{{ employe.poste ? employe.poste.Fonction : 'N/A' }}</td>
          <td>
            <a href="#" class="btn btn-outline-success edit-employe" data-bs-toggle="modal" data-bs-target="#editModal" @click="editEmploye(employe)">Modifier</a>
          </td>
          <td>
            <a :href="`/FicheEmploye/${employe.idEmploye}`" class="btn btn-info px-0">Fiche</a>
          </td>
          <td>
            <form :action="`/employé/delete/${employe.idEmploye}`" method="POST">

              <input type="submit" class="btn btn-outline-danger" value="Supprimer"/>
            </form>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    employes: {
      type: Array,
      required: true
    }
  },
  methods: {
    editEmploye(employe) {
      // Logic to open modal and fill the form with employe data
    }
  }
}
</script>

<style scoped>
/* Your styles here */
</style>
