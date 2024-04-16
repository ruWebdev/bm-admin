<script>

// Импорт разметки для проекта
import MainLayout from '@/Layouts/MainLayout.vue';
import axios from 'axios';

export default {
    layout: MainLayout
};

</script>

<script setup>

import { defineEmits, ref, reactive, watch, onMounted } from 'vue';

import ContentLayout from '@/Layouts/ContentLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps(['data']);

const mainInfoForm = ref({
    title: props.data.event.title,
    age_restrictions: props.data.event.age_restrictions,
    short_description: props.data.event.short_description,
    long_description: props.data.event.long_description,
    event_date: props.data.event.event_date,
    event_time: props.data.event.event_time,
    ticket_price_from: props.data.event.ticket_price_from,
    ticket_price_to: props.data.event.ticket_price_to,
    ticket_price_to: props.data.event.ticket_price_to,
    place: props.data.event.place,
    page_alias: props.data.event.page_alias,
    external_link: props.data.event.external_link,
})

async function saveChanges() {
    try {
        await axios.post('/events/save_changes/' + props.data.event.id, mainInfoForm.value)
    } catch (e) {

    }
}

</script>

<template>

    <Head title="Редактирование события" />

    <ContentLayout>

        <template #PageTitle>
            Редактирование события <span class="ms-2 badge">Не показывается на сайте</span>
        </template>

        <template #RightButtons>
            <button class="btn btn-success me-2" @click="saveChanges()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M14 4l0 4l-6 0l0 -4" />
                </svg>
                Сохранить изменения
            </button>
            <button class="btn btn-info" @click="openNewEventModal()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-checkbox">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 11l3 3l8 -8" />
                    <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                </svg>
                Отправить событие на модерацию
            </button>
        </template>

        <div class="row row-cards">
            <div class="col-md-12 col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                            <li class="nav-item">
                                <a href="#tabs-home-1" class="nav-link active" data-bs-toggle="tab">Основная
                                    информация</a>
                            </li>
                            <li class="nav-item">
                                <a href="#tabs-profile-1" class="nav-link" data-bs-toggle="tab">Изображения и видео</a>
                            </li>
                            <li class="nav-item">
                                <a href="#tabs-profile-1" class="nav-link" data-bs-toggle="tab">Программа</a>
                            </li>
                            <li class="nav-item">
                                <a href="#tabs-profile-1" class="nav-link" data-bs-toggle="tab">Участники</a>
                            </li>
                            <li class="nav-item">
                                <a href="#tabs-profile-1" class="nav-link text-danger" data-bs-toggle="tab">Удаление
                                    события</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tabs-home-1">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label">Название события</label>
                                            <input type="text" class="form-control" name="example-text-input"
                                                placeholder="Input placeholder" v-model="mainInfoForm.title">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Возрастное ограничение</label>
                                            <select class="form-select" v-model="mainInfoForm.age_restrictions">
                                                <option>0+</option>
                                                <option>6+</option>
                                                <option>12+</option>
                                                <option>16+</option>
                                                <option>18+</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Краткое описание для карточки события (не более
                                                100
                                                символов, без точки в конце)</label>
                                            <input type="text" class="form-control" name="example-text-input"
                                                placeholder="Input placeholder" maxlength="100"
                                                v-model="mainInfoForm.short_description">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Подробное описание концерта</label>
                                            <textarea class="form-control" rows="10"
                                                v-model="mainInfoForm.long_description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Дата проведения события</label>
                                            <input type="text" class="form-control" name="example-text-input"
                                                placeholder="Input placeholder" v-model="mainInfoForm.event_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Время проведения события</label>
                                            <input type="text" class="form-control" name="example-text-input"
                                                placeholder="Input placeholder" v-model="mainInfoForm.event_time">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Стоимость билетов ОТ</label>
                                            <input type="text" class="form-control" name="example-text-input"
                                                placeholder="Input placeholder"
                                                v-model="mainInfoForm.ticket_price_from">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label">Стоимость билетов ДО</label>
                                            <input type="text" class="form-control" name="example-text-input"
                                                placeholder="Input placeholder" v-model="mainInfoForm.ticket_price_to">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Место проведения события</label>
                                            <input type="text" class="form-control" name="example-text-input"
                                                placeholder="Input placeholder" v-model="mainInfoForm.place">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Ссылка на событие на сайте BaroqueMusic.ru</label>
                                            <input type="text" class="form-control" name="example-text-input"
                                                placeholder="Input placeholder" v-model="mainInfoForm.page_alias">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Внешняя ссылка на событие (описание, онлайн
                                                продажа
                                                билетов, и т. п.)</label>
                                            <input type="text" class="form-control" name="example-text-input"
                                                placeholder="Input placeholder" v-model="mainInfoForm.external_link">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-profile-1">
                                <h4>Profile tab</h4>
                                <div>Fringilla egestas nunc quis tellus diam rhoncus ultricies tristique enim at diam,
                                    sem nunc
                                    amet, pellentesque id egestas velit sed</div>
                            </div>
                            <div class="tab-pane" id="tabs-settings-1">
                                <h4>Settings tab</h4>
                                <div>Donec ac vitae diam amet vel leo egestas consequat rhoncus in luctus amet, facilisi
                                    sit
                                    mauris accumsan nibh habitant senectus</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </ContentLayout>

</template>