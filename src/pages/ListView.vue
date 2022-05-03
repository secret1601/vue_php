<template>
  <div class="container">

    <div class="card">
      <div class="card-header">
        Todo List
        <button 
          class="btn btn-primary bt-write"
          @click="writeTodo"
        >
            글작성
        </button>

      <!-- 검색필드 -->
      <div class="input-group mr-2 search">
        <input class="form-control" placeholder="search" v-model="searchTxt" @keyup.enter="getTotalSearch()">
      </div>

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
              <td> <span @click="moveDetail(item.id)" class="detail">{{ item.title }}</span></td>              
              <td>
                <input 
                  type="checkbox"
                  class="ml-2 mr-2"
                  :id="item.id"
                  v-model="item.active"
                  @change="toggleTodo(item)"
                >
                <span class="form-check-label" :class="item.active == false ? 'active' : '' ">
                  {{ item.active ? "완료" : "진행중" }}
                </span>
              </td>
              <td>
                <div class="btn-group" role="group">
                  <button class="btn btn-primary" @click="editTodo(item.id)">수정</button>
                  <button class="btn btn-danger" @click="openModal(item.id)">삭제</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>      
    </div>

    <nav aria-label="Page navigation example" v-show="page_total > 1">
      <ul class="pagination">

        <!-- 현재페이지가 1페이지라면 보일 필요없다. -->
        <li class="page-item" v-show="page_now != 1" >   
          <!-- 이전페이지를 보여줌. (page_now - 1) -->       
          <a class="page-link" href="#" @click="getInfo(page_now - 1)">Previous</a>
        </li>

        <li class="page-item" v-for="item in page_total" :key="item">
          <a class="page-link" href="#" @click="getInfo(item)" :class="page_now == item ? 'active' : '' " >{{item}}</a>
        </li>

        <!-- 현재페이지가 마지막 페이지라면 보일 필요없다. -->
        <li class="page-item" v-show="page_now != page_total">
          <!-- 다음페이지를 보여줌. (page_now + 1) -->      
          <a class="page-link" href="#" @click="getInfo(page_now + 1)">Next</a>
        </li>
      </ul>
    </nav>

  </div>

  <!-- 경고창 -->
  <ModalWin 
    v-if="showModal"
    @close="closeModal"
    @delete="deleteTodo"
  />

</template>

<script>
import { ref, watch } from 'vue'
import { useRouter } from 'vue-router'
import ModalWin from '@/components/ModalWin.vue';

export default {
  components : {
    ModalWin
  },
  setup() {
    // 자료 보관 배열
    const todos = ref([]);
    // 서버에서 자료를 읽어오기
    const getInfo = (_page = 1) => {

      page_now.value = _page;
      if(searchActive.value == true) {
        // 검색중이다.
        searchTodo(page_now.value);

        return;
      }

      fetch(`http://secret1601.dothome.co.kr/data_read.php?page_now=${page_now.value}&data_count=${data_count}`)
      .then(res => res.json())
      .then(data => {    
        // 배열데이터를 보관한다.    
        todos.value = data.result
        // todos 의 종류는 배열이다.
        // 배열의 for를 이용해서 접근해서
        // 만약에 각 배열의 complete 가 0, 1 이냐에 따라서
        // 그 값을 반영하는 객체를 추가한다.
        for(let item of todos.value) {
          if(item.complete === '0') {
            item.active = false;
          }else{
            item.active = true;
          }
          console.log(item);
        }
      })
      .catch()
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

    // 할일 삭제 
    const deleteTodo = () => {
           // console.log(_id);
      fetch(`http://secret1601.dothome.co.kr/data_delete.php?id=${deleteId.value}`)
      .then(res => res.json())
      .then(data => {
        // console.log(data);
        // 목록갱신
        if(data.result == 1) {
          // 모달 닫기
          showModal.value = false;
          deleteId.value = null;          
          getInfo();

        }else{
          console.log('삭제에 실패했습니다');
        }        
      })
      .catch()
    }

    // 상태 업데이트
    const toggleTodo = (_obj) => {
      console.log(_obj);
      if(_obj.active == true) {
        _obj.complete = 1;
      }else{
        _obj.complete = 0;
      }

      fetch(`http://secret1601.dothome.co.kr/data_update.php?id=${_obj.id}&title=${_obj.title}&body=${_obj.body}&complete=${_obj.complete}`)
      .then(res => res.json())
      .then(data => {
        console.log(data)
      })
      .catch();
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
          name: "Create"
      });
    }

    // 직접 구현하는 페이지네이션
    // 전체데이터 개수
    const data_total = ref(0);
    // 페이지당 보여줄 개수
    const data_count = 5;
    // 총페이지 수
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

    // 현재 생성된 목록이 검색으로 된 것인지
    // 아니면 검색없이 일반적인 목록인지를 구분하는 변수를 만들자.
    const searchActive = ref(false);
    // 검색 기능 구현
    const searchTxt = ref('');
    // 잦은 검색 php 요청을 하는 것을 방지하는 용도
    // 일정시간 딜레이를 줘서 php 부하를 줄여주는 용도
    let searchTimer = null;
    // seachTxt 가 변하는 것을 감시합니다.
    watch(searchTxt, () => {

      clearTimeout(searchTimer);
      if(searchTxt.value !== '') {
        // 현재 검색중
        searchActive.value = true,
        searchTimer = setTimeout(() => {
          // 검색어와 동일한 내용을 php를 이용해서 
          // 전체 개수를 파악한다.(data_total_search.php)
          getTotalSearch();
        }, 2000);
      } else {
        
        searchActive.value = false,
        getTotal();
      }

    });

    // 검색에 해당하는 총 목록 개수를 가지고 온다.
    const getTotalSearch = () => {
      clearTimeout(searchTimer);
      fetch(`http://secret1601.dothome.co.kr/data_total_search.php?title=${searchTxt.value}`)
      .then(res => res.json())
      .then(data => {
        // 검색어에 해당하는 데이터 개수
        data_total.value = data.total;
        // 몇페이지인가?
        page_total.value = Math.ceil(data_total.value / data_count);
        // 시작 페이지는 1페이지로 셋팅
        page_now.value = 1;
        // 실제 내용 가져오기
        searchTodo();
      })
      .catch();
    }
    // 검새겡 해당되는 내용을 목록으로 가지고 오는 php를 실행
    // data_read_serch.php
    const searchTodo = () => {
      fetch(`http://secret1601.dothome.co.kr/data_read_search.php?page_now=${page_now.value}&data_count=${data_count}&title=${searchTxt.value}`)
      .then(res => res.json())
      .then(data => {
        // 검색된 배열을 받아서 todos를 업데이트 한다.
        todos.value = data.result;
        // complete를 '0'
        for (let item of todos.value ) {
          if(item.complete === '0') {
            item.active = false;
          } else {
              item.active = true;
          }
        }
      })
      .catch();
    }



    return {
      todos,
      deleteTodo,
      moveDetail,
      editTodo,
      writeTodo,
      page_total,
      getInfo,
      page_now,

      closeModal,
      openModal,
      showModal,

      toggleTodo,

      searchTxt,
      getTotalSearch
    }    
  }
}
</script>

<style>
  .detail{
    text-decoration: underline;
    color: #000;
    cursor: pointer;
  }
  .detail:hover {
    color: hotpink;
  }

  .bt-write {
    float: right;
  }

  .active {
    background: hotpink;
    color: #fff;
  }

  .search {
    width: 50%;
    float: right;
  }

</style>