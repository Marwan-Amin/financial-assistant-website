<template>
   <div>
   <span> ({{this.users.length}}) Users Active In This Blog</span>

<ul v-chat-scroll>
  <li class="comment" v-for="(comment,index) in comments.data" :key="index">
                   <div class="vcard bio">
                     <img src="images/person_1.jpg" alt="Image placeholder">
                   </div>
                   <div class="comment-body">
                     <strong>{{comment.user.name}}</strong>
                     <div class="meta">{{comment.created_at}}</div>
                     <p>{{comment.body}}</p>
                     <p><a href="#" class="reply">Reply</a></p>
                   </div>
                 </li>
</ul>


                 <div class="comment-form-wrap pt-5">
                      <pagination :data="comments" @pagination-change-page="getResults"></pagination>

                <h3 class="mb-5">Leave a comment</h3>
                  <div class="form-group">
                    <label for="message">Comment</label>
                    <input 
                    @keydown ="sendTypingEvent"
                    @keyup.enter="sendComment"
                    v-model="newComment"
                    id="inputComment" 
                    type="text"
                    class="form-control"/>
                 <span v-if="activeWritingUser" class="text-muted">{{activeWritingUser.name}} is typing...</span>

                </div>
              </div>

            </div> 

             </div>

</template>

<script>
import moment from 'moment';
    export default {
      // we use vue props and we will bind the auth user in vue template component at show blade page
      props:['user'],
        data() {
            return {
                comments:{},
                newComment:'',
                users:[],
                activeWritingUser:false,
                typingTimer:false,
            }
        },
        created() {
            this.fetchComment();
            Echo.join('comments')
            .here(user=>{
              this.users=user;
            })
            .joining(user=>{
                this.users.push(user);
            })
            .leaving(user=>{
              this.users = this.users.filter(u =>u.id != user.id);
            })
            .listen('LiveCommentEvent',(event)=>{
                this.comments.data.push(event.comment);
            })
            .listenForWhisper('typing',user=>{
              this.activeWritingUser = user;
              //if the writer user keep writing it will reset the timer from the begining to prevent flashing 
              if(this.typingTimer){
                clearTimeout(this.typingTimer);
              }
             this.typingTimer = setTimeout(()=>{
                this.activeWritingUser = false;
              },3000);
            })
        },
        methods: {
          getResults(page =1){
            axios.get('/comments/'+blogId+'?page='+page)
                  .then(response=>{
                    //we get here the object which contain our comments array
                    // in this response as the pagination package need it to be an object passed
                    this.comments = response.data.comments;
                  });
          },
            fetchComment(){
            axios.get('/comments/'+blogId).then(response=>{
                    this.comments = response.data.comments;
            }).catch(error=>{
              alert(error);
            });
            },
            sendComment(){
              //we import moment to form date of comment
              this.comments.data.push({body:this.newComment,user:this.user,created_at:moment(String(new Date())).format('YYYY-MM-DD hh:mm')});
              axios.post('/comments/'+blogId,{comment:this.newComment}).catch(err=>{
                alert(err.message);
              });
              //reset the comment input value
              this.newComment='';
            },
            sendTypingEvent(){
              //when the user is typing we whisper to all users 
              //in this channel that this user is typing we by this sending a client event to  websocket
               Echo.join('comments')
                    .whisper('typing',this.user);
            }
        }
    }
</script>
