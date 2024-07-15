<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Details Form</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Summernote CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <form action="{{ route('admin.store.LoanDeatilsstore', ['user' => $user->id]) }}" method="POST">
            @csrf
            @method('PUT')
                                            
            <h6 class="text-muted mt-4">Loan Approved</h6>
                                            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="interest_rate">Interest Rate</label>
                        <input type="text" name="interest_rate" id="interest_rate"
                               class="form-control mb-4 @error('interest_rate') is-invalid @enderror"
                               value="{{ old('interest_rate', $user->loan->interest_rate ?? '') }}"
                               placeholder="Interest Rate" required>
                        @error('interest_rate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                                            
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="approved_loan_amount">Approved Loan Amount</label>
                        <input type="number" name="approved_loan_amount" id="approved_loan_amount"
                               class="form-control mb-4 @error('approved_loan_amount') is-invalid @enderror"
                               value="{{ old('approved_loan_amount', $user->loan->approved_loan_amount ?? '') }}"
                               placeholder="Approved Loan Amount" required>
                        @error('approved_loan_amount')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                                            
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" name="start_date" id="start_date"
                               class="form-control mb-4 @error('start_date') is-invalid @enderror"
                               value="{{ old('start_date', isset($user->loan->start_date) ? \Carbon\Carbon::parse($user->loan->start_date)->format('Y-m-d') : '') }}"
                               placeholder="Start Date" required>
                        @error('start_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                                            
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <input type="date" name="due_date" id="due_date"
                               class="form-control mb-4 @error('due_date') is-invalid @enderror"
                               value="{{ old('due_date', isset($user->loan->due_date) ? \Carbon\Carbon::parse($user->loan->due_date)->format('Y-m-d') : '') }}"
                               placeholder="Due Date" required>
                        @error('due_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                                            
                <div class="col-12">
                    <div class="form-group">
                        <label for="agreement">Agreement</label>
                        <textarea name="agreement" id="summernote" class="form-control"
                                  rows="5" required>{{ old('agreement', $user->loan->agreement ?? '') }}</textarea>
                    </div>
                </div>
            </div>
                                            
            <button type="submit" class="btn btn-primary mt-3">Update Loan</button>
        </form>
    </div>
                                            
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Include Summernote JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
                                            
    <!-- Initialize Summernote -->
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300, // Set the height of the editor
                placeholder: 'Write your content here...', // Set a placeholder
                tabsize: 2
            });
        });
    </script>
</body>
</html>
