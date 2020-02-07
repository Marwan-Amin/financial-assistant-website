<template>
   <div>

  <li class="comment" v-for="(comment,index) in comments" :key="index">
                   <div class="vcard bio">
                     <img src="images/person_1.jpg" alt="Image placeholder">
                   </div>
                   <div class="comment-body">
                     <h3>{{comment.user.name}}</h3>
                     <div class="meta">{{comment.created_at}}</div>
                     <p>{{comment.body}}</p>
                     <p><a href="#" class="reply">Reply</a></p>
                   </div>
                 </li>

                 <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Leave a comment</h3>
                  <div class="form-group">
                    <label for="message">Comment</label>
                    <textarea  id="inputComment" cols="30" rows="10" class="form-control"></textarea>
                    <button id="postComment" class="btn py-3 px-4 btn-primary">Post A Comment</button>
                 <span class="text-muted">user is typing...</span>

                </div>
              </div>
            </div> 
             </div>

</template>

<script>
    export default {
        data() {
            return {
                messages:''
            }
        },
        created() {
            this.fetchComment();
        },
        methods: {
            fetchComment(){
            axios.get('/comments/'+blogId).then(response=>{
                                     console.log(response);
            }).catch(error=>{
              console.log(error);
            })
            }
        }
    }
</script>
