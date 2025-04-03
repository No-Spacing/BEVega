<script setup>
import Layout from './Layout/Main.vue'
import { useForm, router, Head } from '@inertiajs/vue3'
import { ref, watch } from 'vue'

defineOptions({ layout: Layout })

const props = defineProps({ products: Object, category: Object })

let dialog = ref(false)
let snackbar = ref(false)
let snackbarText = ref("")
let filter = ref(null)
let search = ref(null)

const headers = [
        { title: 'Name' , value: 'name', width: '15%'  },
        { title: 'Category', value: 'category', width: '10%' },
        { title: 'Description', value: 'description' },
        { title: 'Date & Time', value: 'date', width: '10%' },
        { title: 'Actions', value: 'action', width: '6%' }
    ]

const form = useForm({
    id: null,
    name: null,
    category: null,
    description: null,
    date: null,
})

function openDialog(data) {
    this.dialog = true;
    form.id = data.id
    form.name = data.name;
    form.category = data.category;
    form.description = data.description;
    form.date = data.date;
}

function update(){
    form.put('/update-product',{
        onSuccess: () => {
            this.snackbar = true;
            this.snackbarText = "Product updated"
            this.dialog = false;
        }
    })
}

function remove(id){
    if (confirm("Do you want to remove this product?") == true) {
        router.delete('/delete-product/' + id, {
            onSuccess: () => {
                this.snackbar = true;
                this.snackbarText = "Product deleted"
            },
            onError: (error) => {
                console.log(error)
            }
        });
    } 
}

function paginations(){
    router.visit(props.products.links[props.products.current_page].url,
        { preserveState: true }
    )
    
}
function applyFilter(){
    router.get('/products',
        { 
            filter: filter.value,
        },
        { 
            preserveState: true 
        }
    )
}
watch(filter, (newFilter) => {
    router.get('/products',
        {
            filter: newFilter,
        },
        {
            preserveState: true
        }
    )
})
</script>
<template>
    <Head title="Products" />
    <v-snackbar
        v-model="snackbar"
        location="top"
        :timeout="2000"
        color="success"
        variant="outlined"
    >
        {{ snackbarText }}
    </v-snackbar>
    <v-snackbar
        v-model="$page.props.flash.snackbar"
        location="top"
        :timeout="2000"
        color="success"
        variant="outlined"
    >
        <strong>Product</strong> added
    </v-snackbar>
    <div class="d-flex justify-center">
        <v-card title="Products" subtitle="List of products" class="w-100">
           <v-container fluid>
                <v-card-text>
                    <div class="container">
                        <v-btn v-if="$page.props.user.can.create" color="success" href="/create-product" class="mb-5" prepend-icon="mdi-plus-circle">Create</v-btn>
                        <v-row class="justify-space-between">
                            <v-col cols="12" md="5" sm="6">
                                <v-text-field
                                    v-model="search"
                                    append-icon="search"
                                    label="Search"
                                    variant="outlined"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="3" sm="4">
                                <v-form @submit.prevent="applyFilter()">
                                    <v-select 
                                        v-model="filter" 
                                        label="Filter"
                                        variant="outlined"
                                        :items="props.category"
                                        item-title="name"
                                        item-value="name"
                                        chips
                                    ></v-select>
                                    <div class="d-flex justify-end mb-2">
                                        <v-btn type="submit" class="mx-2">Apply Filters</v-btn>
                                        <v-btn href="/products">Remove Filters</v-btn>
                                    </div>
                                </v-form>
                            </v-col>   
                        </v-row>
                    </div>
                    <v-data-table 
                        :search="search"
                        :headers="headers"
                        :items="products.data"
                        :filter-keys="['name','description']"
                        hide-default-footer>
                        <template v-slot:item.action="{ item }" >
                            <v-row class="d-flex">
                                <v-btn v-if="$page.props.user.can.update" class="mx-2 px-2" icon="mdi-pencil" @click="openDialog(item)" size="x-small"></v-btn> 
                                <v-btn v-if="$page.props.user.can.delete" class="mx-2 px-2" icon="mdi-trash-can-outline" @click="remove(item.id)" size="x-small"></v-btn>
                            </v-row>
                        </template>
                    </v-data-table>
                    <div v-if="products.data.length == 0" class="text-center text-h3">No Item</div>

                    <v-pagination 
                        v-model="props.products.current_page" 
                        :length="props.products.last_page" 
                        @update:modelValue="paginations"
                    ></v-pagination>
                    
                    <v-dialog
                        v-model="dialog"
                        width="520px"
                    >
                        <v-card>
                            <v-container fluid>
                                <v-card-title>
                                    Update Product
                                </v-card-title>
                                <v-form @submit.prevent="update()">
                                    <v-card-text>   
                                        <v-text-field 
                                            v-model="form.name" 
                                            label="Name"
                                            :error-messages="$page.props.errors.name"
                                            variant="outlined"
                                        ></v-text-field>
                                        <v-text-field 
                                            v-model="form.category" 
                                            label="Category"
                                            :error-messages="$page.props.errors.category"
                                            variant="outlined"
                                        ></v-text-field >
                                        <v-textarea
                                            v-model="form.description" 
                                            label="Description"
                                            :error-messages="$page.props.errors.description"
                                            variant="outlined"
                                        ></v-textarea>
                                        <v-text-field
                                            v-model="form.date" 
                                            type="date" 
                                            label="Date & Time"
                                            :error-messages="$page.props.errors.date"
                                            variant="outlined"
                                        ></v-text-field>    
                                    </v-card-text>
                                    <v-card-actions class="justify-end">
                                        <v-btn color="primary" @click="dialog = false">Close</v-btn>
                                        <v-btn type="submit">Update</v-btn>
                                    </v-card-actions>
                                </v-form>
                            </v-container>
                        </v-card>
                    </v-dialog>
                </v-card-text>
           </v-container>
        </v-card>
    </div>
</template>