<?php

    namespace Modules\User\Rules;

    use Illuminate\Contracts\Validation\Rule;

    class PasswordRequirement implements Rule
    {

        private string $message;

        /**
         * Create a new rule instance.
         *
         * @return void
         */
        public function __construct()
        {
            $this->message = '영문,숫자,특수문자 포함 8자리 이상 입력.';
        }

        /**
         * Determine if the validation rule passes.
         *
         * @param string $attribute
         * @param mixed  $value
         *
         * @return bool
         */
        public function passes($attribute, $value)
        {
            // Min 8 chars
            if(strlen($value) < 8){
                return false;
            }

            // At least 1 number
            if(!preg_match('/[0-9]{1,}/', $value)){
                return false;
            }

            // At least 1 special char
            if(!preg_match('/[^A-Za-z0-9]{1,}/', $value)){
                return false;
            }

            return true;
        }

        /**
         * Get the validation error message.
         *
         * @return string
         */
        public function message()
        {
            return $this->message;
        }
    }
