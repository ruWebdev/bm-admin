<script>

// Импорт разметки для проекта
import MainLayout from '@/Layouts/MainLayout.vue';
import axios from 'axios';

export default {
    layout: MainLayout
};

</script>

<script setup>

import { ref, reactive, computed, onBeforeMount, onMounted } from 'vue';

import ContentLayout from '@/Layouts/ContentLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const props = defineProps(
    ["data"]
);

const page = usePage()

const state = reactive({
    newComposerModal: null
});

const newComposerForm = ref({
    title: null
});

function openNewComposerModal() {
    newComposerForm.value = {
        last_name: null,
        first_name: null,
    }
    state.newComposerModal.show();
}

function closeNewComposerModal() {
    state.newComposerModal.hide();
}

async function createNewComposer() {
    try {
        const result = await axios.post('/composers/create', {
            data: newComposerForm.value,
        });
        closeNewComposerModal();
        props.data.composers.push(result.data);
    } catch (e) {

    }
}

onMounted(async () => {
    state.newComposerModal = new bootstrap.Modal(document.getElementById('newComposerModal'), {});
});


</script>

<template>

    <Head title="Композиторы" />

    <ContentLayout>

        <template #PageTitle>
            Композиторы
        </template>

        <template #RightButtons>
            <a href="#" class="btn btn-primary" @click="openNewComposerModal()">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                </svg>
                Добавить композитора
            </a>
        </template>
        <div class="row row-cards">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Список новостей</h3>
                    </div>
                    <div class="card-body p-0 m-0">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Фамилия</th>
                                        <th>Имя</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="news in props.data.composers">
                                        <td>{{ news.last_name }}</td>
                                        <td>{{ news.first_name }}</td>
                                        <td>
                                            <Link :href="'/composers/view/' + news.id">Редактировать</Link>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal modal-blur fade" id="newComposerModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Добавление композитора</h5>
                        <button type="button" class="btn-close" @click="closeNewComposerModal()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Фамилия</label>
                                    <input type="text" class="form-control" name="example-text-input"
                                        placeholder="Заполните поле" v-model="newComposerForm.last_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Имя</label>
                                    <input type="text" class="form-control" name="example-text-input"
                                        placeholder="Заполните поле" v-model="newComposerForm.first_name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" @click="closeNewComposerModal()">Отменить</button>
                        <button type="button" class="btn btn-primary" @click="createNewComposer()">Создать
                            композитора</button>
                    </div>
                </div>
            </div>
        </div>

    </ContentLayout>
</template>
