import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, usePage } from "@inertiajs/react";

export default function Feature({ feature, answer, children }) {
    const { auth } = usePage().props;

    const availableCredits = auth.user.available_credits;
    console.log(
        auth.user,
        availableCredits,
        parseInt(feature.required_credits)
    );

    return (
        <>
            <AuthenticatedLayout
                user={auth.user}
                header={
                    <h2 className="font-semibold text-xl text-black dark:text-gray-200 leading-tight">
                        {feature.name ? feature.name : "No feature name"}
                    </h2>
                }
            >
                <Head title="Feature 1" />
                <div className="py-12  flex items-center justify-center w-full">
                    <div className="max-w-7xl">
                        {answer ? (
                            <div className="mb-3 py-3 px-5 rounded-2xl text-white bg-indigo-600">
                                Result of calculation: {answer}
                            </div>
                        ) : null}
                        <div className="bg-white w-full sm:w-[600px] md:w-[700px] lg:w-[800px]  dark:bg-gray-800 overflow-hidden shadow-2xl rounded-3xl 2xl:rounded-2xl relative">
                            {availableCredits ? (
                                parseInt(feature.required_credits) >
                                availableCredits ? (
                                    <div className="absolute left-0 top-0 right-0 bottom-0 z-20 flex flex-col items-center justify-center bg-white/70 gap-3">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="size-6"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"
                                            />
                                        </svg>
                                        <div>
                                            You do not have enough credits for
                                            this feature. Go {" "}
                                            <Link
                                                href={route('credit.index')}
                                                className="underline"
                                            >
                                                Buy more credits
                                            </Link>{" "}
                                        </div>
                                    </div>
                                ) : null
                            ) : null}
                            <div className="p-8 text-gray-400 border-b pb-4">
                                <p>{feature.description ? "LLLL" : "que"}</p>
                                <p className="text-sm text-right font-bold">
                                    Requires{" "}
                                    {feature.required_credits
                                        ? feature.required_credits
                                        : "N/A"}{" "}
                                    credits
                                </p>
                            </div>
                            {children}
                        </div>
                    </div>
                </div>
            </AuthenticatedLayout>
        </>
    );
}
