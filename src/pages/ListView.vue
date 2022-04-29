<template>
    <div class="container">

        <div class="card">
            <div class="card-header">
                Todo List
                <button class="btn btn-success bt-write" @click="writeTodo">글작성</button>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Title</th>
                            <th>Complete</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in todos" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td> <span @click="moveDetail(item.id)" class="detail">{{ item.title }}</span> </td>
                            <td>{{ item.complete }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-primary" @click="editTodo(item.id)">수정</button>
                                    <button class="btn btn-danger" @click="deleteTodo(item.id)">삭제</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>

            <li v-for="item in page_total " :key="item" class="page-item">
                <a class="page-link" href="#" @click="getInfo(item)">{{item}}</a>
            </li>

            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
        </nav>

    </div>
</template>

<script>
import { useRouter } from 'vue-router'
    import {
        ref
    } from 'vue'

    export default {

        setup() {
            // 자료 보관 배열
            const todos = ref([]);
            // 서버에서 자료를 읽어오기
            const getInfo = (_page = 1) => {
                page_now.value = _page;
                fetch(`http://secret1601.dothome.co.kr/data_read.php?page_now=${page_now.value}&data_count=${data_count}`)
                    .then(res => res.json())
                    .then(data => {
                        todos.value = data.result
                    })
                    .catch()
            }

            // 할일 삭제 
            const deleteTodo = (_id) => {
                // console.log(_id);
                fetch(`http://secret1601.dothome.co.kr/data_delete.php?id=${_id}`)
                    .then(res => res.json())
                    .then(data => {
                        console.log(data);
                        // 목록갱신
                        if (data.result == 1) {
                            getInfo();
                        } else {
                            console.log('삭제에 실패했습니다.');
                        }
                    })
                    .catch()
            }

            // 상세보기 기능
            const router = useRouter();
            const moveDetail = (_id) => {
                // console.log(_id);
                router.push({
                    name: 'Detail',
                    params: {
                        id: _id
                    }
                });
            }

            // 수정하기
            const editTodo = (_id) => { 
                router.push({
                    name: 'Update',
                    params: { id: _id }
                });
            }

            const writeTodo = () => {
                router.push({
                    name: 'Create'
                });
            }

            // 전체 데이터 개수
            const data_total = ref(0);
            // 페이지당 보여줄 개수
            const data_count = 5;
            // 총 페이지수 
            const page_total = ref(0);
            // 현재 페이지
            const page_now = ref(1);
            // 전체 데이터 수 받아오기
            const getTotal = () => {
                fetch(`http://secret1601.dothome.co.kr/data_total.php`)
                .then(res => res.json())
                .then(data => {
                    // 전체 데이터 수 갱신
                    data_total.value = data.total;
                    // 페이지 계산하기
                    // 전체 페이지 갱신
                    page_total.value = Math.ceil(data_total.value / data_count);
                    page_now.value = 1;
                    
                    getInfo();
                })
                .catch();
            }
            getTotal();

            return {
                todos,
                deleteTodo,
                moveDetail,
                editTodo,
                writeTodo,
                page_total,
                getInfo
            }
        }
    }
</script>

<style>

    .detail {
        text-decoration: underline;
        color: #000;
        cursor: pointer;
    }

    .detail:hover {
        color: hotpink;
    }

    .bt-write {
        position: relative;
        display: block;
        float: right;
    }

</style>