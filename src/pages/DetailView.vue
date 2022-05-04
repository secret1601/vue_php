<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Todo
            </div>
            <div class="card-body">
                <h4 class="card-title">{{todo.title}}</h4>
                <p class="card-text">{{todo.body}}</p>
                <p class="card-text">
                    {{todo.complete === '0' ? '진행중' : '완료'}}
                </p>
                <div class="btn-group" role="group" aria-label="">
                    <button type="button" class="btn btn-warning" @click="editTodo(todo.id)">수정</button>
                    <button type="button" class="btn btn-danger" @click="openModal(todo.id)">삭제</button>
                    <button type="button" class="btn btn-primary" @click="moveList">목록보기</button>
                </div>
            </div>
        </div>
    </div>
    <teleport to="#popup">
        <!-- 경고창 -->
        <ModalWin 
            v-if="showModal"
            @close="closeModal"
            @delete="deleteTodo"
        >
            <template v-slot:title>할일삭제</template>
            <template v-slot:body>정말 삭제하시겠습니까?</template>
        </ModalWin>
    </teleport>

</template>

<script>
   import { reactive, ref } from 'vue';
   import { useRoute, useRouter } from 'vue-router'
   import ModalWin from '@/components/ModalWin.vue';

   export default {
        components : {
            ModalWin
        },
        setup() {
            const route = useRoute();  
            // 타이틀
            const todo = reactive({
                title: '',
                body: '',
                id: 0,
                complete: 0
            });
            // console.log(route.params.id);
            // 아이디를 전달하고 자료를 받아온다.
            const getInfo = () => {
                fetch(`http://secret1601.dothome.co.kr/data_read_id.php?id=${route.params.id}`)
                .then(res => res.json())
                .then(data => {
                    // console.log(data);
                    todo.title = data.result[0].title;
                    todo.body = data.result[0].body;
                    todo.complete = data.result[0].complete;
                    todo.id = data.result[0].id;
                })
                .catch()
            }

            getInfo();

            // 할일 삭제 
            const router = useRouter();
            const deleteTodo = () => {
                // console.log(_id);
                fetch(`http://secret1601.dothome.co.kr/data_delete.php?id=${deleteId.value}`)
                .then(res => res.json())
                .then(data => {
                    if(data.result == 1) {
                            router.push({
                            name: "List"
                        });
                    }else{
                        console.log('삭제에 실패했습니다');
                    }        
                })
                .catch()
            }
                        
            // 수정하기
            const editTodo = (_id) => {
                router.push({
                    name: 'Update',
                    params: { id: _id }
                });
            }

            // 목록으로 이동
            const moveList = () => {
                    router.push({
                    name: "List"
                });
            }
            // 모달창 닫기
            // 모달이 보여지는 상태를 저장한다.
            const showModal = ref(false);
            // 선택된 id 를 저장한다.
            const deleteId = ref(null); 

            const closeModal = () => {
                // 모달창 안보이게 처리
                showModal.value = false;
                deleteId.value = null;
            }
            // 모달창 보여주기
            const openModal = (_id) => {
                // 삭제해야 하는 아이디 저장
                deleteId.value = _id;
                // 모달을 보여주고
                showModal.value = true;
            }

            return {
                todo,
                deleteTodo,
                editTodo,
                moveList,
                closeModal,
                openModal,
                showModal
            }
        }
    }
</script>

<style>

</style>