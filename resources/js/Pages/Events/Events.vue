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
    newEventModal: null
});

const newEventForm = ref({
    title: null,
    event_type: null,
});

function openNewEventModal() {
    newEventForm.value = {
        title: null,
        event_type: null,
    }
    state.newEventModal.show();
}

function closeNewEventModal() {
    state.newEventModal.hide();
}

async function createNewEvent() {
    try {
        const result = await axios.post('/events/create', newEventForm.value);
        closeNewEventModal();
        props.data.events.push(result.data);
    } catch (e) {

    }
}

onMounted(async () => {
    state.newEventModal = new bootstrap.Modal(document.getElementById('newEventModal'), {});
});


</script>

<template>

    <Head title="События" />

    <ContentLayout>

        <template #PageTitle>
            События
        </template>

        <template #RightButtons>
            <a href="#" class="btn btn-primary" @click="openNewEventModal()">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                </svg>
                Добавить событие
            </a>
        </template>
        <div class="row row-cards">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Список событий</h3>
                    </div>
                    <div class="card-body p-0 m-0">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Навание</th>
                                        <th>Исполнитель</th>
                                        <th>Дата проведения</th>
                                        <th>Статус</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="event in props.data.events">
                                        <td>{{ event.title }}</td>
                                        <td class="text-muted">
                                            <template v-if="event.artist != 0">{{ event.artist }}</template>
                                            <template v-else>Не указан</template>
                                        </td>
                                        <td class="text-muted">
                                            <template v-if="event.event_date != null">{{ event.event_date }}</template>
                                            <template v-if="event.event_time != null">, {{ event.event_time
                                                }}</template>
                                            <template v-if="event.event_time == null || event.event_time == ''">Не
                                                указан</template>
                                        </td>
                                        <td class="text-muted">
                                            <template v-if="event.status == 0">Добавлено</template>
                                        </td>
                                        <td>
                                            <Link :href="'/events/view/' + event.id">Редактировать</Link>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal modal-blur fade" id="newEventModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Добавление нового события</h5>
                        <button type="button" class="btn-close" @click="closeNewEventModal()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Название события</label>
                                    <input type="text" class="form-control" name="example-text-input"
                                        placeholder="Заполните поле" v-model="newEventForm.title">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p><small>Название события будет отображаться на страницах сайта</small></p>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Тип события</label>
                                <select class="form-select" v-model="newEventForm.event_type">
                                    <option value="1">Концерт, Театр, Представление</option>
                                    <option value="2">Мастер-класс, Лекция, Экскурсия</option>
                                    <option value="3">Другое</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" @click="closeNewEventModal()">Отменить</button>
                        <button type="button" class="btn btn-primary" @click="createNewEvent()">Создать событие</button>
                    </div>
                </div>
            </div>
        </div>

    </ContentLayout>
</template>
