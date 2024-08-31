import { useState } from "react";
import Feature from "@/Components/Feature";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import { useForm } from "@inertiajs/react";

export default function Index({ feature, initialAnswer }) {
    const { data, setData, post, reset, errors, processing } = useForm({
        user_prompt: "",
    });

    const [answer, setAnswer] = useState(initialAnswer);
    const [isPending, setIsPending] = useState(false);

    const submit = async (e) => {
        e.preventDefault();
        setIsPending(true);

        try {
            const response = await post(route("feature2.ollamaResponse"), {
                preserveState: true,
                onSuccess: (page) => {
                    const newAnswer = page.props.answer;
                    setAnswer(newAnswer);
                    setIsPending(false);
                },
            });

            reset();
        } catch (error) {
            console.error("Error:", error);
        }
    };

    return (
        <Feature feature={feature} answer={answer}>
            <form onSubmit={submit} className="p-8 grid grid-cols-1 gap-3">
                <div className="">
                    <InputLabel
                        htmlFor="user_prompt"
                        value="Ask down here..."
                    />
                    <TextInput
                        id="user_prompt"
                        type="text"
                        name="user_prompt"
                        value={data.user_prompt}
                        className="mt-1 block w-full"
                        onChange={(e) => setData("user_prompt", e.target.value)}
                    />
                    <InputError
                        message={errors?.user_prompt}
                        className="mt-2"
                    />
                </div>
                <div className="flex items-center justify-end mt-4 col-span-2">
                    {isPending ? (
                        <div className="text-black">
                            <button
                                type="button"
                                class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-indigo-600 hover:bg-indigo-500 transition ease-in-out duration-150 cursor-not-allowed"
                                disabled=""
                            >
                                <svg
                                    class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <circle
                                        class="opacity-25"
                                        cx="12"
                                        cy="12"
                                        r="10"
                                        stroke="currentColor"
                                        stroke-width="4"
                                    ></circle>
                                    <path
                                        class="opacity-75"
                                        fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                    ></path>
                                </svg>
                                Processing...
                            </button>
                        </div>
                    ) : (
                        <PrimaryButton className="ms-4" disabled={processing}>
                            Ask
                        </PrimaryButton>
                    )}
                </div>
            </form>
        </Feature>
    );
}
