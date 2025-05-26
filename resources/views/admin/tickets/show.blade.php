@extends('layouts.main')

@section('css')
<style>
    .chat-box {
        height: 350px;
        padding: 10px;
        overflow-y: scroll;
        border: 1px solid #ccc;
        background: white;
        border-radius: 5px;
        scroll-behavior: smooth; /* Cuộn mượt hơn */
    }

    .chat-box-message {
        margin: 5px 0;
        display: flex;
        flex-direction: column;
    }

    .chat-box-message-item {
        margin: 5px 0;
    }

    .chat-box-message-item-content-left {
        /* padding: 15px 10px;
        border-radius: 5px; */
        float: left;
        text-align: left;
        /* background-color: #f0f0f0;
        color: #000; */
    }

    .chat-box-message-item-content-right {
        /* padding: 15px 10px;
        border-radius: 5px; */
        float: right;
        text-align: right;
        /* background-color: #1a78c4;
        color: white; */
    }

    .chat-box-message-item-content-right .badge {
        background-color: #1a78c4;
        padding: 10px;
        color: white;
        font-size: 15px;
        font-weight: normal;
    }

    .chat-box-message-item-content-left .badge {
        background-color: #f0f0f0;
        padding: 10px;
        color: #000;
        border: 1px solid #ccc;
        font-size: 15px;
        font-weight: normal;
    }

    .chat-box-message-item-content-right-time {
        font-size: 12px;
        color: #6c757d;
        text-align: right;
    }

    .chat-box-message-item-content-left-time {
        font-size: 12px;
        color: #6c757d;
        text-align: left;
    }

    .input-group {
        margin-top: 10px;
    }

    input[type="text"] {
        width: calc(100% - 100px);
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        padding: 10px;
        border: none;
        background-color: #007bff;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>
@endsection

@section('page_title')
    Chi tiết ticket
@endsection

@section('title')
    Chi tiết ticket
@endsection

@section('buttons')
@endsection

@section('content')

<div ng-controller="Ticket" ng-cloak>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h6>Đoạn chat</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="chat-box">
                                <div class="chat-box-body">
                                    <div class="chat-box-message" ng-repeat="log in ticket_logs">
                                        <div class="chat-box-message-item">
                                            <div class="chat-box-message-item-content-right" ng-if="log.user_create.id == current_user.id">
                                                <p class="mb-0"><span class="badge badge-pill badge-primary"><% log.message %></span> Tôi</p>
                                                <div class="chat-box-message-item-content-right-time">
                                                    <% log.created_at | toDate | date:'dd/MM/yyyy HH:mm' %>
                                                </div>
                                            </div>
                                            <div class="chat-box-message-item-content-left" ng-if="log.user_create.id != current_user.id">
                                                <p class="mb-0"><% log.user_create.name %> <span class="badge badge-pill badge-primary"><% log.message %></span></p>
                                                <div class="chat-box-message-item-content-left-time">
                                                    <% log.created_at | toDate | date:'dd/MM/yyyy HH:mm' %>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($ticket->status != \App\Model\Admin\Ticket::STATUS_CLOSED)
                            <div class="input-group">
                                <textarea type="text" ng-model="newMessage" placeholder="Nhập tin nhắn..." class="form-control" rows="3"></textarea>
                                <button class="btn btn-primary" ng-click="sendMessage()"><i class="fa fa-paper-plane"></i> Gửi tin nhắn</button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Thông tin chung</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Tiêu đề: <b style="font-size: 18px;"><% form.title %></b></p>
                            <p>Địa chỉ IP: <b><% form.ips %></b></p>
                            <p>Trạng thái: <b><span class="badge badge-pill badge-<% getStatus(form.status).type %>"><% getStatus(form.status).name %></span></b></p>
                            @if (!Auth::user()->is_customer)
                                <p>Khách hàng: <b><% form.user.name %></b></p>
                            @endif
                            <p>Ngày tạo: <b><% form.created_at | toDate | date:'dd/MM/yyyy HH:mm' %></b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="text-right">
        <a href="{{ route('Ticket.index') }}" class="btn btn-danger btn-cons">
            <i class="fa fa-remove"></i> Quay lại
        </a>
    </div>
</div>
@endsection

@section('script')
    @include('admin.tickets.Ticket')
    <script>
        app.controller('Ticket', function ($scope, $http, $timeout) {
            $scope.form = new Ticket(@json($ticket), {scope: $scope});
            $scope.statuses = @json(\App\Model\Admin\Ticket::STATUSES);
            $scope.ticket_logs = @json($ticket_logs);
            $scope.current_user = DEFAULT_USER;
            $scope.$applyAsync();

            $scope.getStatus = function (status) {
                let obj = $scope.statuses.find(val => val.id == status);
                return obj;
            }

            $scope.newMessage = '';

            $scope.sendMessage = function() {
                if ($scope.newMessage.trim() !== '') {
                    const newLog = {
                        user_create: { id: $scope.current_user.id, name: $scope.current_user.fullname },
                        message: $scope.newMessage,
                        created_at: new Date()
                    };
                    $scope.ticket_logs.push(newLog);

                    $.ajax({
                        url: '{{ route('Ticket.update', $ticket->id) }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: {
                            message: newLog.message
                        },
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(response) {
                            console.log(response);
                        },
                        complete: function() {
                            $scope.newMessage = ''; // Xóa nội dung input
                            $scope.$applyAsync();
                        }
                    });
                }

                // Đợi DOM cập nhật xong rồi cuộn xuống
                scrollToBottom(true);
            };


            // Hàm cuộn xuống
            function scrollToBottom(force = false) {
                setTimeout(() => {
                    const chatBox = document.querySelector('.chat-box-body');
                    if (chatBox) {
                        const lastMessage = chatBox.lastElementChild; // Lấy tin nhắn cuối cùng
                        if (lastMessage) {
                            lastMessage.scrollIntoView({ behavior: 'instant', block: 'end' });
                        }
                    }
                }, 50);
            }

            // Theo dõi danh sách tin nhắn và cuộn khi có tin mới
            $scope.$watchCollection('ticket_logs', function (newLogs, oldLogs) {
                if (newLogs.length > oldLogs.length) {
                    scrollToBottom();
                }
            });

            // Cuộn xuống khi trang tải xong
            $timeout(() => {
                scrollToBottom(true);
            }, 500);
        });
    </script>
@endsection
